<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.loginnew');
    }

    public function login(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            "username" => $credentials['username'],
            "password" => $credentials['password'],
            "status" => "aktif"
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', "selamat datang " . auth()->user()->nama);
        } elseif (Auth::attempt([
            "username" => $credentials['username'],
            "password" => $credentials['password'], 
            "status" => "nonaktif"
        ])) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return back()->withErrors([
                'username' => "status nonaktif",
            ]);
        }



        return back()->withErrors([
            'username' => "username atau password salah",
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
