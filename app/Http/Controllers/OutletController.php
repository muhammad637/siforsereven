<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    //
    /**
     * Display a listing of the outlet.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $this->authorize('manage_outlet');
        // $outletQuery = Outlet::query();
        // $outletQuery->where('name', 'like', '%' . request('q') . '%');
        // $outlets = $outletQuery->paginate(25);
        // return $outletQuery;
        return view('outlets.map', compact('outlets'));
    }

    /**
     * Show the form for creating a new outlet.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Outlet);
        $users = User::where('outlet_id', null)
            ->where('cekLevel', 'teknisi')
            ->orderBy('nama', 'asc')
            ->get();
        return view('outlets.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Outlet);
        $newOutlet = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $outlet = Outlet::create($newOutlet);
        // return $outlet->id;
        $user = User::find($request->user_id);
        $user->update(['outlet_id' => $outlet->id]);
        // return $user;
        // $newOutlet['creator_id'] = auth()->user()->id;


        return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Display the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function show(Outlet $outlet)
    {
        return view('outlets.show', compact('outlet'));
    }

    /**
     * Show the form for editing the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function edit(Outlet $outlet)
    {
        $this->authorize('update', $outlet);
        $users = User::where('cekLevel', 'teknisi')
        ->orderBy('nama', 'asc')
        ->get();
        return view('outlets.edit', [
            'outlet' => $outlet,
            'users' => $users
        ]);
    }

    /**
     * Update the specified outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        $outletData = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
        $outlet->update($outletData);
        User::find($request->user_id)
            ->update(['outlet_id' => $outlet->id]);
        return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Outlet $outlet)
    {
        $this->authorize('delete', $outlet);
        $request->validate(['outlet_id' => 'required']);
        User::where('outlet_id', $outlet->id)->update(['outlet_id' => null]);
        if ($request->get('outlet_id') == $outlet->id && $outlet->delete()) {
            return redirect()->route('outlet_map.index');
        }
        return back();
    }
}
