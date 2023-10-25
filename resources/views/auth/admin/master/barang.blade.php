@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title')
    Master Barang
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Barang', 'master' => 'Master Data'])
    <div class="row mt-4 mx-4 ">

        <div class="card px-3 pt-0 pb-2">
            <div class="mt-3 mx-3">
                <h5>List Barang</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                    Tambah
                </button>
            </div>
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 text-center table-flush" id="myTable">
                    <thead>
                        <tr class="text-center">
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Jenis
                                Barang</th>
                            <th
                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7  ps-2">
                                Merk Barang
                            </th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Tipe
                                Barang/Seri</th>
                            <th
                                class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Status</th>
                            <th
                                class="text-center text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ">
                                Aksi</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-uppercase">{{ $barang->jenis->jenis }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">
                                        {{ $barang->merk->merk }}</p>
                                </td>

                                <td>
                                    <p class="text-sm text-uppercase font-weight-bold mb-0">
                                        {{ $barang->tipe->tipe }}</p>
                                </td>

                                <td>
                                    <span
                                        class="text-center badge badge-sm {{ $barang->status == 'nonaktif' ? 'bg-gradient-secondary' : 'bg-gradient-success' }}">{{ $barang->status }}</span>
                                </td>
                                <td class="align-middle text-end">
                                    <div class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                        <a href="#modaledit-{{ $barang->id }}" data-bs-toggle="modal"
                                            class="badge bg-warning">edit</a>
                                        @if ($barang->status == 'aktif')
                                            <form action="{{ route('nonaktif.barang', ['barang' => $barang->id]) }}"
                                                method="post" class="inline-block">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="badge bg-gradient-danger border-0"><i
                                                        class="fa fa-times-circle" aria-hidden="true"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('aktif.barang', ['barang' => $barang->id]) }}"
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

                            <div class="modal fade" id="modaledit-{{ $barang->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modaledittbarang" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-capitalize" id="modaleditbarang">Form Edit
                                                barang {{ $barang->tipe->tipe }} {{ $barang->merk->merk }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('update.barang', ['barang' => $barang->id]) }}"
                                            method="post">
                                            @method('put')
                                            @csrf
                                            <input type="hidden" value="{{ $barang->id }}" name="current_barang">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="">Jenis Barang</label>
                                                        <div class="input-group mb-4">
                                                            {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                                            <select class="form-control text-capitalize" name="jenis_id"
                                                                id="jenis-{{ $barang->id }}">
                                                                @foreach ($jenis as $j)
                                                                    @if ($j->status == 'aktif')
                                                                        <option value="{{ $j->id }}"
                                                                            {{ $j->id == $barang->jenis->id ? 'selected' : '' }}
                                                                            class="text-uppercase">
                                                                            {{ $j->jenis }}</option>
                                                                    @endif
                                                                @endforeach
                                                                <option value="jenis_other">lainnya ...</option>
                                                            </select>
                                                            <span class="input-group-text">
                                                                <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group" id="jenis_other-{{ $barang->id }}"
                                                            style="display:none;">
                                                            <label for="other" class="text-capitalize">jenis Barang
                                                                Lainnya</label>
                                                            <div class="input-group mb-4">
                                                                <input class="form-control" placeholder="jenis Barang ..."
                                                                    name="jenis" type="text">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- merk barang --}}
                                                    <div class="col-md-6">
                                                        <label for="">Merk Barang</label>
                                                        <div class="input-group mb-4">
                                                            {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                                            <select class="form-control text-capitalize" name="merk_id"
                                                                id="merk-{{ $barang->id }}">
                                                                @foreach ($merks as $merk)
                                                                    @if ($merk->status == 'aktif')
                                                                        <option value="{{ $merk->id }}"
                                                                            {{ $barang->merk->id == $merk->id ? 'selected' : '' }}
                                                                            class="text-uppercase">
                                                                            {{ $merk->merk }}</option>
                                                                    @endif
                                                                @endforeach
                                                                <option value="merk_other">lainnya ...</option>
                                                            </select>
                                                            <span class="input-group-text">
                                                                <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="merk_other-{{ $barang->id }}"
                                                            style="display:none;">
                                                            <label for="other" class="text-capitalize">merk Barang
                                                                Lainnya</label>
                                                            <div class="input-group mb-4">
                                                                <input class="form-control" placeholder="Merk Barang ..."
                                                                    name="merk" type="text">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- tipe barang --}}
                                                    <div class="col-md-6">
                                                        <label for="">Tipe Barang/Seri</label>
                                                        <div class="input-group mb-4">
                                                            {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                                            <select class="form-control text-capitalize" name="tipe_id"
                                                                id="tipe-{{ $barang->id }}">
                                                                @foreach ($tipes as $tipe)
                                                                    @if ($tipe->status == 'aktif')
                                                                        <option value="{{ $tipe->id }}"
                                                                            {{ $tipe->id == $barang->tipe_id ? 'selected' : '' }}
                                                                            class="text-uppercase">
                                                                            {{ $tipe->tipe }}</option>
                                                                    @endif
                                                                @endforeach
                                                                <option value="tipe_other">lainnya ...</option>
                                                            </select>
                                                            <span class="input-group-text">
                                                                <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="tipe_other-{{ $barang->id }}"
                                                            style="display:none;">
                                                            <label for="other" class="text-capitalize">tipe Barang/Seri
                                                                Lainnya</label>
                                                            <div class="input-group mb-4">
                                                                <input class="form-control" placeholder="Tipe Barang ..."
                                                                    name="tipe" type="text">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>





                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn bg-gradient-primary">Save</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- script edit -->

                            <script>
                                $(document).ready(function() {
                                    $("#jenis-{{ $barang->id }}").change(function() {
                                        if ($(this).val() === 'jenis_other') {
                                            $("#jenis_other-{{ $barang->id }}").show();
                                        } else {
                                            $("#jenis_other-{{ $barang->id }}").hide();
                                        }
                                    });
                                    $("#merk-{{ $barang->id }}").change(function() {
                                        if ($(this).val() === 'merk_other') {
                                            $("#merk_other-{{ $barang->id }}").show();
                                        } else {
                                            $("#merk_other-{{ $barang->id }}").hide();
                                        }
                                    });
                                    $("#tipe-{{ $barang->id }}").change(function() {
                                        if ($(this).val() === 'tipe_other') {
                                            $("#tipe_other-{{ $barang->id }}").show();
                                        } else {
                                            $("#tipe_other-{{ $barang->id }}").hide();
                                        }
                                    });
                                });
                            </script>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
        <div class="row mt-2 mx-4 text-capitalize justify-content-start">
            <!-- jenis barang -->
            <div class="col-md-4 my-2">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($jenis as $j)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $j->jenis }}</p>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- tipe barang -->

            <div class="col-md-4 my-2">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Merk
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($merks as $merk)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $merk->merk }}</p>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- tipe barang -->

            <div class="col-md-4 my-2">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tipe/seri
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipes as $tipe)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 ps-3">{{ $tipe->tipe }}</p>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="" style="height: 100vh;"></div>

        <!-- Modal Tambah Barang -->
        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-capitalize" id="modaltambahLabel">Form tambah barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('store.barang') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Jenis Barang</label>
                                    <div class="input-group mb-4">
                                        {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                        <select class="form-control text-capitalize" name="jenis_id" id="jenis">
                                            <option value="" selected>jenis barang ..</option>
                                            @foreach ($jenis as $j)
                                                @if ($j->status == 'aktif')
                                                    <option value="{{ $j->id }}" class="text-uppercase">
                                                        {{ $j->jenis }}</option>
                                                @endif
                                            @endforeach
                                            <option value="jenis_other">lainnya ...</option>
                                        </select>
                                        <span class="input-group-text">
                                            <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" id="jenis_other" style="display:none;">
                                        <label for="other" class="text-capitalize">jenis Barang Lainnya</label>
                                        <div class="input-group mb-4">
                                            <input class="form-control" placeholder="jenis Barang ..." name="jenis"
                                                type="text">
                                            <span class="input-group-text">
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- merk barang --}}
                                <div class="col-md-6">
                                    <label for="">Merk Barang</label>
                                    <div class="input-group mb-4">
                                        {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                        <select class="form-control text-capitalize" name="merk_id" id="merk">
                                            <option value="" selected>merk barang ..</option>
                                            @foreach ($merks as $merk)
                                                @if ($merk->status == 'aktif')
                                                    <option value="{{ $merk->id }}" class="text-uppercase">
                                                        {{ $merk->merk }}</option>
                                                @else
                                                    <option value="{{ $merk->id }}" disabled
                                                        class="text-uppercase text-secondary">
                                                        {{ $merk->merk }}</option>
                                                @endif
                                            @endforeach
                                            <option value="merk_other">lainnya ...</option>
                                        </select>
                                        <span class="input-group-text">
                                            <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="merk_other" style="display:none;">
                                        <label for="other" class="text-capitalize">merk Barang Lainnya</label>
                                        <div class="input-group mb-4">
                                            <input class="form-control" placeholder="Merk Barang ..." name="merk"
                                                type="text">
                                            <span class="input-group-text">
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                {{-- tipe barang --}}
                                <div class="col-md-6">
                                    <label for="">Tipe Barang</label>
                                    <div class="input-group mb-4">
                                        {{-- <input type="text" class="form-control" name="merk" placeholder="merk barang .." > --}}
                                        <select class="form-control text-capitalize" name="tipe_id" id="tipe">
                                            <option value="" selected>merk barang ..</option>
                                            @foreach ($tipes as $tipe)
                                                @if ($tipe->status == 'aktif')
                                                    <option value="{{ $tipe->id }}" class="text-uppercase">
                                                        {{ $tipe->tipe }}</option>
                                                @endif
                                            @endforeach
                                            <option value="tipe_other">lainnya ...</option>
                                        </select>
                                        <span class="input-group-text">
                                            <i class="fa fa-exchange" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="tipe_other" style="display:none;">
                                        <label for="other" class="text-capitalize">tipe Barang Lainnya</label>
                                        <div class="input-group mb-4">
                                            <input class="form-control" placeholder="Tipe Barang ..." name="tipe"
                                                type="text">
                                            <span class="input-group-text">
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
