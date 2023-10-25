@extends('layouts.app')

{{-- @section('title', __('outlet.list')) --}}
@section('title') Lokasi
@endsection
@section('content')

@include('layouts.navbars.auth.topnav',["title" => "Outlets","master" => "index"])

{{-- <div class="row mt-4 mx-4">
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h5>List Users</h5>
            <a href="#" class="btn bg-gradient-primary">
               + Alamat 
            </a>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Level
                                </th>

                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    NIK</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    No Hp</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->id !== auth()->user()->id)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->username }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->cekLevel }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->nik }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->no_telephone }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm {{ $user->status == 'nonaktif' ? 'bg-gradient-secondary' : 'bg-gradient-success' }}">{{ $user->status }}</span>
                                        </td>

                                        <td class="align-middle text-end">
                                            <div
                                                class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                                <a href="#modalEdit-{{ $user->id }}" data-bs-toggle="modal"
                                                    class="badge bg-warning">edit</a>
                                                @if ($user->status == 'aktif')
                                                    <a href="{{ route('user.nonaktif', ['user' => $user->id]) }}"
                                                        class="badge bg-danger">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                @else
                                                    <a href="{{ route('user.aktif', ['user' => $user->id]) }}"
                                                        class="badge bg-success "><i class="fa fa-check-circle-o"
                                                            aria-hidden="true"></i></a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>                                    
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="" style="height:100vh;"></div>
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Models\Outlet)
            <a href="{{ route('outlets.create') }}" class="btn btn-success">{{ __('outlet.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('outlet.list') }} <small>{{ __('app.total') }} : {{ $outlets->total() }} {{ __('outlet.outlet') }}</small></h1>
</div> --}}

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
@endsection
