<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class notifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::with('notifikasi')->find(auth()->user()->id);
        $notifikasi = $user->notifikasi()->orderBy('created_at', 'desc')->get();
        // return $notifikasi;
        return view('pages.notifikasi', [
            'title' => 'notifikasi',
            'notifikasis' => $notifikasi
        ]);
    }

    public function mark()
    {
        //
        $datas = User::with('notifikasi')->where('id', auth()->user()->id)->first();
        $data = $datas->notifikasi->where('mark', 'false');
        // $data = DB::table('notifikasis')->get();
        foreach ($data as $not) {
            Notifikasi::where('id', $not->id)->update(['mark' => 'true']);
        }
        $data = User::with(['notifikasi' => function ($query) {
            $query->orderBy('created_at', 'desc')->limit(3);
        }])->orderBy('created_at', 'desc')->where('id', auth()->user()->id)->first()->notifikasi;
        return response()->json($data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifikasi $notifikasi)
    {
        //
    }
}
