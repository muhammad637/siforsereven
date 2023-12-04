<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders =  Order::where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->orderBy('tanggal_order', 'desc')->get();
        $ruangans =  Ruangan::orderBy('nama','asc')->get();
        if (auth()->user()->cekLevel == 'admin') {
            $orders =  Order::where('status', null)->orWhere('status', 'on progress')->orderBy('tanggal_order', 'desc')->get();
        }
        // return $orders;
        if ($request->ajax()) {
            $orders =  Order::query()->where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->orderBy('created_at', 'desc');
            if (auth()->user()->cekLevel == 'admin') {
                $orders =  Order::query()->where('status', null)->orWhere('status', 'on progress')->orderBy('created_at', 'desc');
            }
            // return $orders;
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('tanggal_order', function ($item) {
                    return Carbon::parse($item->created_at)->format('d-M-Y H:i:s');
                })
                ->addColumn('ruangan', function ($item) {
                    return $item->ruangan->nama;
                })
                ->addColumn('tanggal_selesai', function ($item) {
                    $tanggal_selesai = $item->tanggal_selesai;
                    return $tanggal_selesai ? Carbon::parse($item->tanggal_selesai)->format('d-M-Y') : '-';
                })
                ->addColumn('barang',function($order){
                         return  $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe ;
                })
                ->addColumn('status',function($order){
                         return $order->status == null ? 'pending' : $order->status ;
                })
                ->addColumn('hub-pelapor','auth.admin.pages.part.hub-pelapor')
                ->addColumn('hub-teknisi','auth.admin.pages.part.hub-teknisi')
                ->addColumn('pesan-service','auth.admin.pages.part.pesan-service')
                ->addColumn('print','auth.admin.pages.part.print')
                ->addColumn('aksi','auth.admin.pages.part.aksi')
                ->rawColumns(['status','tanggal_order','hub-pelapor','barang','ruangan','tanggal_selesai','aksi','print','hub-teknisi','pesan-service','print'])
                ->make(true);
                // ->toJson();
        }
        return view('auth.admin.pages.order', [
            'orders' => $orders,
            'barangs' => Barang::where('status','aktif')->orderBy('merk_id', 'asc')->get(),
            'users' => User::where('cekLevel', 'teknisi')->where('status', 'aktif')->get(),
            'ruangans' => $ruangans,
            'parse' => function ($date) {
                return Carbon::parse($date)->format('d-M-Y');
            },
'parse_hour' => function ($hour) {
                return Carbon::parse($hour)->format('H:i:s');
            }
        ]);
    }

    public function store(Request $request)
    {
        // validasi data
        $validatedData = $request->validate([
            'barang_id' => 'required',
            'pesan_kerusakan' => 'required',
            'user_id' => 'required',
            'tanggal_order' => '',
            'ruangan_id' => 'required',
            'nama_pelapor' => 'required',
            'no_pelapor' => 'required'
        ]);
        $validatedData['tanggal_order'] = now()->format('Y-m-d');
        // ambil data barang dan teknisi
        $barang = Barang::find($request->barang_id);
        $teknisi = User::find($request->user_id);
        try {
            // create order
            Order::create($validatedData);

            // ambil data yang telah dibuat tadi
            $order = Order::latest()->first();

            // membuat pesan untuk notifikasi
            $pesan = "servisan dengan id: $order->id : barang: " . $order->barang->jenis->jenis . " " . $order->barang->merk->merk . " " . $order->barang->merk->merk . " dari " . auth()->user()->nama . " berhasil dibuat untuk teknisi : $teknisi->nama dengan pesan kerusakan $request->pesan_kerusakan ";
            // pembuatan dan emanggilan fungsi notif di kelas Notifikasi
            $notif = Notifikasi::notif('servisan', $pesan, 'buat', 'berhasil');
            // create notifikasi buat teknisi dan admin
            Notifikasi::create($notif)->user()->attach($request->user_id);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            // memunculkan sweetalert
            Alert::success('success', $pesan);
            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }



    public function printout(Order $order){
        return view('auth.admin.pages.orderprint',[
            'order' => $order
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $barang = Barang::find($order->barang_id);
        $teknisi = User::find($order->user_id);
        $validatedData = $request->validate([
            'status' => 'required',
            'pesan_status' => 'required',
            'tanggal_selesai' => '',
        ]);
        // $validatedData = ['tanggal_selesai' => Carbon::parse('25-8-2022')->format('d-m-Y')];
        try {
            $pesan = "servisan dengan id $order->id barang " . $barang->jenis->jenis . " " . $barang->merk->merk . " " . $barang->tipe->tipe . " berhasil diupdate oleh $teknisi->nama dengan perubahan status : $request->status";
            $notif = Notifikasi::notif('order', $pesan, 'update', 'berhasil');
            Notifikasi::create($notif)->user()->attach(auth()->user()->id);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            //code...
            $order->update($validatedData);
            if ($request->status == "selesai") {
                $order->update(['status_selesai' => $request->status_selesai]);
                if($request->tanggal_selesai == null ){
                    $order->update(['tanggal_selesai' => now()]);
                }
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function tes(Request $request){

        // return 'testing';
        if($request->ajax()){
            $orders =  Order::query()->where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->orderBy('created_at', 'desc');
            if (auth()->user()->cekLevel == 'admin') {
                $orders =  Order::query()->where('status', null)->orWhere('status', 'on progress')->orderBy('created_at', 'desc');
            }
            // return $orders;
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('tes', function ($item) {
                    return Carbon::parse($item->created_at)->format('d-M-Y H:i:s');
                })
                ->rawColumns(['tes'])
                ->toJson();
        }
    }
}
