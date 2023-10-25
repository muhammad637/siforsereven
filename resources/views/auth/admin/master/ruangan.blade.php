@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title') Master Ruangan
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Barang', 'master' => 'Master Data'])
    <div class="row mt-4 mx-4 ">
       
        <div class="card px-3 pt-0 pb-2">
            <div class="mx-3 mt-3">
                <h5>List Ruangan</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah
                </button>
            </div>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 text-center table-flush" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Nama Ruangan</th>
                            <th
                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7  ps-2">
                                No Ruangan
                            </th>
                            <th
                                class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Status</th>
                            <th
                                class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Aksi</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($ruangans as $ruangan)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-uppercase">{{ $ruangan->nama }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">
                                        {{ $ruangan->no_ruangan }}</p>
                                </td>
                                <td>
                                    <span
                                        class="text-center badge badge-sm {{ $ruangan->status == 'nonaktif' ? 'bg-gradient-secondary' : 'bg-gradient-success' }}">{{ $ruangan->status }}</span>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                        <a href="#modaledit-{{ $ruangan->id }}" data-bs-toggle="modal"
                                            class="badge bg-warning">edit</a>
                                        @if ($ruangan->status == 'aktif')
                                            <form action="{{ route('ruangan.nonaktif', ['ruangan' => $ruangan->id]) }}"
                                                method="post" class="inline-block">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="badge bg-gradient-danger border-0"><i
                                                        class="fa fa-times-circle" aria-hidden="true"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('ruangan.aktif', ['ruangan' => $ruangan->id]) }}"
                                                method="post">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="badge bg-gradient-success border-0"><i
                                                        class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- modal edit -->

                            <div class="modal fade" id="modaledit-{{ $ruangan->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modaledittruangan" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-capitalize" id="modaleditruangan">Form Edit
                                                ruangan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('update.ruangan',['ruangan' => $ruangan->id]) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Nama Ruangan</label>
                                                        <div class="input-group mb-4">
                                                            <input type="text" class="form-control" name="nama" placeholder="nama ruangan .." value="{{$ruangan->nama ? $ruangan->nama : '' }}" >
                                                            <span class="input-group-text">
                                                                <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="">No Ruangan </label>
                                                        <div class="input-group mb-4">
                                                            <input type="text" class="form-control" name="no_ruangan" placeholder="example 123" value="{{$ruangan->no_ruangan ? $ruangan->no_ruangan : '' }}" >
                                                            <span class="input-group-text">
                                                                <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn bg-gradient-primary">Save</button>
                                            </div>
                        
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- script edit -->

                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            

    </div>
    <div class="" style="height: 100vh;"></div>
    <!-- Modal Tambah ruangan -->
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-capitalize" id="modaltambahLabel">Form tambah ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.ruangan') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nama Ruangan</label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" name="nama" placeholder="nama ruangan .." >
                                    <span class="input-group-text">
                                        <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Nomer Ruangan </label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" name="no_ruangan" placeholder="example 123" >
                                    <span class="input-group-text">
                                        <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
