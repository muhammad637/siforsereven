<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        return view(
            'auth.admin.master.user.index',
            [
                'users' => User::orderBy('created_at','desc')->get()
            ]
        );
    }

    public function syalal()
    {
        if (view()->exists("pages.profile-static")) {
            return view("pages.profile-static");
        }

        return abort(404);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notif = Notifikasi::notif('user', "user: $request->nama berhasil di tambahkan by " . auth()->user()->nama, 'tambah' , 'berhasil');
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'username' => 'required |unique:users,username',
                'password' => 'required',
                'nik' => 'required |unique:users,nik',
                'no_telephone' => 'required',
                'cekLevel' => 'required'
            ]
        );
        try{
            User::create($validatedData);
            Notifikasi::create($notif)->user()->sync(User::adminId());
            $user = User::where('username', $request->username)->first();
            return redirect()->back()->with('toast_success','data berhasil ditambahkan');
        }
        catch(\Throwable $th){
            return $th->getMessage();
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('auth.admin.master.user.edit');
       
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required |' . Rule::unique('users')->ignore($user->id),
            'password' => '',
            'nik' => 'required|max:16',
            'cekLevel' => 'required',
            'no_telephone' => 'required'
            // 'no_telephone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
        try {
            //code...
            if (!$validatedData['password']) {
            
                $validatedData['password'] = $user->password;
            }
            $notif= Notifikasi::notif('user', "user: $request->nama berhasil diupdate by " . auth()->user()->nama, 'update', 'berhasil');
            Notifikasi::create($notif)->user()->sync(User::adminId());
            $user->update($validatedData);
            return redirect()->back()->with('toast_success','data user berhasil diupdate');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function aktif(Request $request, User $user){
        $pesan = 'user ' . "$user->nama berhasil diaktifkan by ". auth()->user()->nama ;
        Alert::toast($pesan,'success');
        $notif = Notifikasi::notif('user', $pesan, 'aktif' , 'berhasil');
        Notifikasi::create($notif)->user()->sync(User::adminId());
        $user->update(['status' => 'aktif']);
        return redirect()->back()->with('toast_success', 'berhasil aktifkan user' . $user->nama );
        // return redirect()->back();
    }
    public function nonaktif(User $user){
        $pesan = 'user ' . "$user->nama berhasil dinonaktifkan by " . auth()->user()->nama ;
        Alert::toast($pesan,'success');
        $notif = Notifikasi::notif('user', $pesan, 'nonaktif' , 'berhasil');
        Notifikasi::create($notif)->user()->sync(User::adminId());
        $user->update(['status' => 'nonaktif']);
        return redirect()->back()->with('toast_success', 'berhasil dinonaktifkan user' . $user->nama );
        // return redirect()->back();
    }
}
