<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use NunoMaduro\Collision\Adapters\Phpunit\Printer;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::where('cekLevel', 'teknisi')->where('status', 'aktif')->get();
        $orderOnprogress = Order::where('user_id', auth()->user()->id)
            ->where('status', 'on progress')->count();
 $orderPending = Order::where('user_id', auth()->user()->id)
            ->where('status', null)->count();
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')->limit(10)->get();
        $barang = Barang::all()->count();
        if (Auth::user()->cekLevel == 'admin') {
            $orderOnprogress = Order::where('status', 'on progress')->count();
            $orders = Order::orderBy('created_at', 'desc')->limit(10)->get();
        }
        // return $komputer;
        return view('pages.dashboard', [
            'jumlahBarang' => $barang,
            'orderOnprogress' => $orderOnprogress,
'orderPending' => $orderPending,
            'users' => $user,
            'orders' => $orders,
            'parse' => function ($date) {
                return Carbon::parse($date)->format('d-M-Y');
            },
'parse_hour' => function ($hour) {
                return Carbon::parse($hour)->format('H:i:s');
            }
        ]);
    }
}
