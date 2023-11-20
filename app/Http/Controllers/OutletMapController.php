<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletMapController extends Controller
{
    //
    public function index(Request $request)
    {
        // return 'testing';
        $outlets = Outlet::orderBy('created_at','desc')->get();
        return view('outlets.map',[
            'outlets'=>$outlets
        ]);
    }
    // public function map_rsud()
    // {
    //     return view('outlets.map');
    // }

}
