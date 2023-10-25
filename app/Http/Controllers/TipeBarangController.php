<?php

namespace App\Http\Controllers;

use App\Models\TipeBarang;
use App\Http\Requests\StoreTipeBarangRequest;
use App\Http\Requests\UpdateTipeBarangRequest;

class TipeBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTipeBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipeBarangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipeBarang  $tipeBarang
     * @return \Illuminate\Http\Response
     */
    public function show(TipeBarang $tipeBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipeBarang  $tipeBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(TipeBarang $tipeBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipeBarangRequest  $request
     * @param  \App\Models\TipeBarang  $tipeBarang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipeBarangRequest $request, TipeBarang $tipeBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipeBarang  $tipeBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipeBarang $tipeBarang)
    {
        //
    }
}
