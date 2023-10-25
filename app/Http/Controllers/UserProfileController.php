<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use RealRashid\SweetAlert\Facades\Alert;
// use Alert;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('pages.user-profile');
    }

    public function update(Request $request, User $user)
    {

        $notif = Notifikasi::notif('user', "data anda berhasil diupdate", 'update', 'berhasil');
        $validatedData = $request->validate([
            'no_telephone' => 'required',
            'nama' => 'required'
            //'username' => 'required|'.Rule::unique('users')->ignore($user->id)
        ]);
        Notifikasi::create($notif)->user()->attach(auth()->user()->id);
        $user->update($validatedData);
        // return $user;
        return redirect(route('profile'))->with('toast_success', $notif['msg']);
    }

    public function resetPassword(Request $req, User $user)
    {
        // try {
        //code...
        $notif = Notifikasi::notif('user', 'password berhasil diupdate', 'update', 'berhasil');
        $req->validate([
            'old_password' => ['required'],
            'password' => ['required', 'min:8'],
        ], [
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);
        if (!Hash::check($req->old_password, $user->password)) {
            # code...
            return redirect()->back()->with('toast_error', 'password lama tidak valid');
        }
        if ($req->password == $req->password_confirmation) {
            $user->update([
                'password' => $req->password,
            ]);
            Auth::logout();
            $req->session()->invalidate();
            $req->session()->regenerateToken();
            // $req->session()->flash('toast_success', $notif['msg']);
            return redirect('/login')->with('success',$notif['msg']);
            // return back();
        } else {
            # code...
            return redirect()->back()->with('toast_error', 'passwrd baru dan konfirmasi password tidak sesuai');
        }
    }
}