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
class OrderController extends Controller
{
    public function index()
    {
        $orders =  Order::where('user_id', auth()->user()->id)->where('status', null)->orWhere('status', 'on progress')->orderBy('tanggal_order', 'desc')->get();
        $ruangans =  Ruangan::orderBy('nama','asc')->get();
        if (auth()->user()->cekLevel == 'admin') {
            $orders =  Order::where('status', null)->orWhere('status', 'on progress')->orderBy('tanggal_order', 'desc')->get();
        }
 
        // return $orders;
        return view('auth.admin.pages.order', [
            'barangs' => Barang::where('status','aktif')->orderBy('merk_id', 'asc')->get(),
            'users' => User::where('cekLevel', 'teknisi')->where('status', 'aktif')->get(),
            'orders' => $orders,
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
}
