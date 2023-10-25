<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\OrderExport;
use App\Models\JenisBarang;
use Maatwebsite\Excel\Facades\Excel;


class HistoryController extends Controller
{
    //
    public function index()
    {
        $history = Order::where('status', 'selesai')->orderBy('updated_at', 'desc')->get();
        $barang = Barang::orderBy('jenis_id', 'asc')->get();
        $jns_barangs = JenisBarang::orderBy('jenis', 'asc')->get();
        if (auth()->user()->cekLevel == 'teknisi') {
            # code...
            $history = Order::where('user_id', auth()->user()->id)->where('status', 'selesai')->orderBy('updated_at', 'desc')->get();
        }

        if (session()->has('history')) {
            # code...
            $history = session()->get('history');
        }
        return view('auth.admin.pages.history', [
            'historys' => $history,
            'barangs' => $barang,
            'jenis_barangs' => $jns_barangs,
        ]);
    }

    public function historyBulan(Request $request)
    {
        $bulan = Carbon::parse($request->bulan)->format('m');
        $tahun = Carbon::parse($request->bulan)->format('Y');
        $history = Order::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('status', 'selesai')
            ->get();
        // jika teknisi yang filter
        if (auth()->user()->cekLevel == 'teknisi') {
            $history = Order::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->where('status', 'selesai')
                ->where('user_id', auth()->user()->id)
                ->get();
        }
        session()->flash('pageTitle', 'bulan');
        $byBulan = Carbon::parse($request->bulan)->format('M - Y');
        session()->flash('header', " history  bulan $byBulan");
        session()->flash('teks', "history pada bulan $byBulan ini masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            session()->flash('history', $history);
            session()->flash('header', " History Bulan $byBulan");
        }
        return redirect()->back();
        // return 'tes';
    }
    public function historyJenisBarang(Request $request)
    {
        $jenis = JenisBarang::findOrFail($request->jenis_id);
        $jenis_id = $request->jenis_id;
        $history = Order::where('status', 'selesai')->whereHas('barang', function ($query) use ($jenis_id) {
            $query->where('jenis_id', $jenis_id);
        })->get();

        // jika teknisi yang filter
        if (auth()->user()->cekLevel == 'teknisi') {
            $history = Order::where('status', 'selesai')->whereHas('barang', function ($query) use ($jenis_id) {
                $query->where('jenis_id', $jenis_id);
            })->where('user_id', auth()->user()->id)->get();
        }

        session()->flash('header', " History Jenis Barang $jenis->jenis");
        // session()->flash('teks', "orderan di ruangan $request->nama_ruangan masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            // $header = $history[0]->ruangan->nama_ruangan;
            session()->flash('history', $history);
        }
        session()->flash('pageTitle', 'barang');
        return redirect()->back();
    }
    public function historyBarang(Request $request)
    {
        $barang = Barang::find($request->barang_id);
        $jenis = $barang->jenis->jenis;
        $merk = $barang->merk->merk;
        $tipe = $barang->tipe->tipe;
        $history = Order::where('status', 'selesai')->where('barang_id', $request->barang_id)->get();
        // jika teknisi yang filter
        if (auth()->user()->cekLevel == 'teknisi') {
            $history = Order::where('status', 'selesai')->where('barang_id', $request->barang_id)
                ->where('user_id', auth()->user()->id)->get();
            # code...
        }
        session()->flash('header', " History Barang $jenis $merk $tipe");
        // session()->flash('teks', "orderan di ruangan $request->nama_ruangan masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            // $header = $history[0]->ruangan->nama_ruangan;
            session()->flash('history', $history);
        }
        session()->flash('pageTitle', 'barang');
        return redirect()->back();
    }

    public function historyStatus(Request $request)
    {
        // $barang = Barang::find($request->barang_id);
        // $merk = $barang->merk->merk;
        $history = Order::where('status_selesai', $request->status_selesai)->get();
        // jika teknisi yang filter
        if (auth()->user()->cekLevel == 'teknisi') {
            $history = Order::where('status_selesai', $request->status_selesai)->where('user_id', auth()->user()->id)->get();
            # code...
        }
        session()->flash('header', " History service status $request->status_selesai");
        // session()->flash('teks', "orderan di ruangan $request->nama_ruangan masih kosong");
        session()->flash('history', 'tidak ada');
        if (count($history) > 0) {
            # code...
            // $header = $history[0]->ruangan->nama_ruangan;
            session()->flash('history', $history);
        }
        session()->flash('pageTitle', 'barang');
        return redirect()->back();
    }

    public function exportAll()
    {
        $data = $this->dataLaporan(Order::where('status','selesai')->orderBy('updated_at', 'desc')->get(), 'LIST LAPORAN SIFORSEVEN');
        return $data;
    }
    public function exportBulan(Request $request)
    {
        $byBulan = Carbon::parse($request->bulan)->format('M Y');
        $bulan = Carbon::parse($request->bulan)->format('m');
        $tahun = Carbon::parse($request->bulan)->format('Y');
        $data = $this->dataLaporan(
            Order::whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->where('status','selesai')
                ->get(),
            "LIST LAPORAN SIFORSEVEN BULAN $byBulan"
        );
        return $data;
    }
    public function exportBarang(Request $request)
    {
        $order = Barang::find($request->barang_id);
        $namaBarang = $order->jenis->jenis . '-' . $order->merk->merk . '' . $order->tipe->tipe;
        $data = $this->dataLaporan(
            Order::where('status','selesai')->where('barang_id', $request->barang_id)->get(),
            "LIST LAPORAN SIFORSEVEN BY BARANG $namaBarang"
        );
        return $data;
    }
    public function exportJenisBarang(Request $request)
    {
        $jenis_id = $request->jenis_id;
        $jenis = JenisBarang::findOrFail($jenis_id);
        // return $jenis;
        $data = $this->dataLaporan(
            Order::where('status','selesai')
                ->whereHas('barang', function ($query) use ($jenis_id) {
                    $query->where('jenis_id', $jenis_id);
                })->get(),
            "LIST LAPORAN SIFORSEVEN BY JENIS BARANG : $jenis->jenis"
        );
        return $data;
    }

    private function dataLaporan($orders, $judul = 'LIST LAPORAN SIFORSEVEN')
    {

        $dataLaporan = [];
        foreach ($orders as $order) {
            array_push($dataLaporan, [
                'tanggal order' => Carbon::parse($order->tanggal_order)->format('d/M/Y'),
                'tanggal selesai' => Carbon::parse($order->tanggal_selesai)->format('d/M/Y'),
                'nama Teknisi' => $order->user->nama,
                'nama Barang' => $order->barang->jenis->jenis . "-" . $order->barang->merk->merk . " " . $order->barang->tipe->tipe,
                'nama ruangan' => $order->ruangan->nama,
                'pesan kerusakan' => $order->pesan_kerusakan,
                'status' => "$order->status | $order->status_selesai",
                'pesan satus' => $order->pesan_status,
            ]);
        }
        $laporan = new OrderExport([
            [$judul],
            ['Tanggal Order', 'Tanggal Selesai', 'Nama Teknisi', 'Nama Barang', 'Nama Ruangan', 'Kerusakan', 'Status', 'Pesan Status',],
            [...$dataLaporan]
        ]);
        return Excel::download($laporan, 'laporan siforseven.xlsx');
    }


    // updatehistory
    public function update(Request $request, Order $order)
    {
        return "berhasil";
        // $barang = Barang::find($order->barang_id);
        // $teknisi = User::find($order->user_id);
        // $validatedData = $request->validate([
        //     'status_selesai' => '',
        //     'pesan_status' => 'required',
        //     'tanggal_selesai' => '',
        // ]);
        // // $validatedData = ['tanggal_selesai' => Carbon::parse('25-8-2022')->format('d-m-Y')];
        // try {
        //     $pesan = "servisan dengan id $order->id barang " . $barang->jenis->jenis . " " . $barang->merk->merk . " " . $barang->tipe->tipe . " berhasil diupdate oleh $teknisi->nama dengan perubahan status : $request->status";
        //     $notif = Notifikasi::notif('order', $pesan, 'update', 'berhasil');
        //     Notifikasi::create($notif)->user()->attach(auth()->user()->id);
        //     Notifikasi::create($notif)->user()->sync(User::adminId());
        //     //code...
        //     $order->update($validatedData);
        //     // $order->update(['status_selesai' => $request->status_selesai]);
        //     return redirect()->back();
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return $th->getMessage();
        // }
    }
}
