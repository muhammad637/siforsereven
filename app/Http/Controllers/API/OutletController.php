<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Resources\Outlet as OutletResource;


class OutletController extends Controller
{
    //
    public function index(Request $request)
    {
        $outlets = Outlet::all();
        // return $outlets;
        // return OutletResource::collection($outlets);
        // $ores = new OutletResource();
        // return $outlets;
        $geoJSONdata = $outlets->map(function ($outlet) {
            return [
                'type'       => 'Feature',
                'properties' => $outlet,
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $outlet->longitude,
                        $outlet->latitude,
                    ],
                ],
            ];
        });
        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
