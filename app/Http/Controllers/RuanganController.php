<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class RuanganController extends Controller
{
    //
    public function index(){
      
        $ruangan = Ruangan::all();
        return view('auth.admin.master.ruangan', [
            'ruangans' => Ruangan::orderBy('nama', 'asc')->get(),
        ]);
    }
    public function store(Request $request){
        $notif = Notifikasi::notif('Ruangan', "Ruangan : $request->nama berhasil di tambahkan by " . auth()->user()->nama, 'tambah' , 'berhasil');
        $validateData = $request->validate([
            'nama' => 'required|unique:ruangans,nama',
            'no_ruangan' => '',
        ]);
        try {
            //code...
            Ruangan::create($validateData);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            // $user = User::where('username', $request->username)->first();
            Alert::success('berhasil menambahkan data');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
    public function update(Request $request, Ruangan $ruangan){
        $notif = Notifikasi::notif('Ruangan', "user : $request->nama berhasil diupdate bu " . auth()->user()->nama, 'update' , 'berhasil');
        $validateData = $request->validate([
            'nama' => 'required|'.Rule::unique('ruangans')->ignore($ruangan->id),
            'no_ruangan' => '',
        ]);
        try {
            //code...
            $ruangan->update($validateData);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            Alert::success('berhasil update data');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
    public function ruanganAktif(Ruangan $ruangan)
    {
        $status = 'aktif';
        // Barang::where('id', $ruangan->id)->update(['status' => $status]);
        $ruangan->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil aktifkan ruangan' . $ruangan->nama );
    }
    public function ruanganNonaktif(Ruangan $ruangan)
    {
        $status = 'nonaktif';
        // Barang::where('id', $ruangan->id)->update(['status' => $status]);
        $ruangan->update(['status' => $status]);
        return redirect()->back()->with('toast_success', 'berhasil nonaktifkan ruangan' . $ruangan->nama );
    }
}
