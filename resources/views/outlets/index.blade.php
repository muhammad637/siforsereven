@extends('layouts.app')

{{-- @section('title', __('outlet.list')) --}}
{{-- @section('title') Lokasi
@endsection
@section('content')
<div class="main-panel" style="height: 100vh;">
    <div class="content">
        @include('layouts.navbars.auth.topnav',["title" => "Outlets","master" => "index"])
        <div class="row mt-4 mx-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>List Outlet</h4>
                    </div>
                    <table class="table table-sm table-responsive-sm" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Lattitude</th>
                                <th>Longitude</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outlets as $outlet)
                            <tr class="text-capitalize">
                                <td class="text-center">{{ $loop->iteration}}</td>
                                <td>{!! $outlet->name_link !!}</td>
                                <td>{{ $outlet->address }}</td>
                                <td>{{ $outlet->latitude }}</td>
                                <td>{{ $outlet->longitude }}</td>
                                <td class="text-center">
                                    <a href="{{ route('outlets.show', $outlet) }}" id="show-outlet-{{ $outlet->id }}" class="badge bg-warning">Show</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}
