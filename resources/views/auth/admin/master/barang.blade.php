@extends('layouts.app', ['title' => 'Barang', 'title'])
@section('title')
    Master Barang
@endsection
@section('content')
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>


    <div class="main-panel">
        @include('layouts.navbars.auth.topnav', ['title' => 'Barang', 'master' => 'Master Data'])
        <div class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">List Barang</h4>

                            <button type="button" class="btn bg-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> Tambah
                            </button>

                        </div>

                        <div class="card-body" style="height: 100%;">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead class=" text-secondary">
                                        <th class="text-center">JENIS BARANG</th>
                                        <th class="text-center">MERK BARANG</th>
                                        <th class="text-center">TIPE BARANG/SERI</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $barang->jenis->jenis }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $barang->merk->merk }}
                                                </td>
                                                <td class="text-center"> {{ $barang->tipe->tipe }}</td>
                                                <td class="text-center" style="color: white;">
                                                    <span
                                                        class="text-center badge badge-sm {{ $barang->status == 'nonaktif' ? 'bg-primary' : 'bg-success' }}">{{ $barang->status }}</span>
                                                </td>


                                                <td class="text-center">
                                                    <div
                                                        class="d-flex px-3 py-1 justify-content-center align-items-center gap-1">
                                                        <a href="#modaledit-{{ $barang->id }}" data-bs-toggle="modal"
                                                            class="badge bg-warning" style="color: white">edit</a>
                                                        @if ($barang->status == 'aktif')
                                                            <form
                                                                action="{{ route('nonaktif.barang', ['barang' => $barang->id]) }}"
                                                                method="post" class="inline-block">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="badge bg-danger border-0"
                                                                    style="color: white"><i class="fa fa-times-circle"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('aktif.barang', ['barang' => $barang->id]) }}"
                                                                method="post">
                                                                @method('put')
                                                                @csrf
                                                                <button type="submit" class="badge bg-success border-0"
                                                                    style="color: white"><i class="fa fa-check-circle-o"
                                                                        aria-hidden="true"></i></button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modaledit-{{ $barang->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modaltambahLabel">Form Edit Barang
                                                            </h5>

                                                        </div>
                                                        <form
                                                            action="{{ route('update.barang', ['barang' => $barang->id]) }}"
                                                            method="post">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Jenis Barang</label>
                                                                            <div class="input-group mb-4">
                                                                                <select class="form-control" name="jenis_id"
                                                                                    id="jenis-{{$barang->id}}">
                                                                                    <option value="" selected>Jenis
                                                                                        barang ..</option>
                                                                                    @foreach ($jenis as $j)
                                                                                        @if ($j->status == 'aktif')
                                                                                            <option
                                                                                                value="{{ $j->id }}"
                                                                                                class="text-uppercase">
                                                                                                {{ $j->jenis }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <option value="jenis_other">Lainyaa ...
                                                                                    </option>
                                                                                </select>
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-exchange"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" id="jenis_other-{{$barang->id}}"
                                                                            style="display:none;">
                                                                            <label for="other"
                                                                                class="text-capitalize">jenis Barang
                                                                                Lainnya</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="jenis Barang ..."
                                                                                    name="jenis" type="text">
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-plus-square"
                                                                                        aria-hidden="true"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Merk Barang</label>
                                                                            <div class="input-group mb-4">
                                                                                <select class="form-control"
                                                                                    name="merk_id" id="merk-{{$barang->id}}">
                                                                                    <option value="" selected>Merk
                                                                                        barang ..</option>
                                                                                    @foreach ($merks as $merk)
                                                                                        @if ($merk->status == 'aktif')
                                                                                            <option
                                                                                                value="{{ $merk->id }}"
                                                                                                class="text-uppercase">
                                                                                                {{ $merk->merk }}
                                                                                            </option>
                                                                                        @else
                                                                                            <option
                                                                                                value="{{ $merk->id }}"
                                                                                                disabled
                                                                                                class="text-uppercase text-secondary">
                                                                                                {{ $merk->merk }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <option value="merk_other">lainnya ...
                                                                                    </option>
                                                                                </select>
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-exchange"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" id="merk_other-{{$barang->id}}"
                                                                            style="display:none;">
                                                                            <label for="other"
                                                                                class="text-capitalize">merk Barang
                                                                                Lainnya</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="Merk Barang ..."
                                                                                    name="merk" type="text">
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-plus-square"
                                                                                        aria-hidden="true"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Tipe Barang</label>
                                                                            <div class="input-group mb-4">
                                                                                <select class="form-control"
                                                                                    name="tipe_id" id="tipe-{{$barang->id}}">
                                                                                    <option value="" selected>Tipe
                                                                                        barang ..</option>
                                                                                    @foreach ($tipes as $tipe)
                                                                                        @if ($tipe->status == 'aktif')
                                                                                            <option
                                                                                                value="{{ $tipe->id }}"
                                                                                                class="text-uppercase">
                                                                                                {{ $tipe->tipe }}
                                                                                            </option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    <option value="tipe_other">lainnya ...
                                                                                    </option>
                                                                                </select>
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-exchange"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" id="tipe_other-{{$barang->id}}"
                                                                            style="display:none;">
                                                                            <label for="other"
                                                                                class="text-capitalize">Tipe Barang
                                                                                Lainnya</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="Tipe Barang ..."
                                                                                    name="tipe" type="text">
                                                                                <span class="input-group-text">
                                                                                    <i class="fa fa-plus-square"
                                                                                        aria-hidden="true"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        $("#jenis-{{$barang->id}}").change(function() {
                                                                            if ($(this).val() === 'jenis_other') {
                                                                                $("#jenis_other-{{$barang->id}}").show();
                                                                            } else {
                                                                                $("#jenis_other-{{$barang->id}}").hide();
                                                                            }
                                                                        });
                                                                        $("#merk-{{$barang->id}}").change(function() {
                                                                            if ($(this).val() === 'merk_other') {
                                                                                $("#merk_other-{{$barang->id}}").show();
                                                                            } else {
                                                                                $("#merk_other-{{$barang->id}}").hide();
                                                                            }
                                                                        });
                                                                        $("#tipe-{{$barang->id}}").change(function() {
                                                                            if ($(this).val() == 'tipe_other') {
                                                                                $("#tipe_other-{{$barang->id}}").show();
                                                                            } else {
                                                                                $("#tipe_other-{{$barang->id}}").hide();
                                                                            }
                                                                        });
                                                                    });
                                                                </script>

                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn bg-gradient-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn bg-primary">Save</button>
                                                                </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        tipe/seri
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

        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaltambahLabel">Form Tambah Barang</h5>

                    </div>
                    <form action="{{ route('store.barang') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Jenis Barang</label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" name="jenis_id" id="jenis">
                                                <option value="" selected>Jenis barang ..</option>
                                                @foreach ($jenis as $j)
                                                    @if ($j->status == 'aktif')
                                                        <option value="{{ $j->id }}" class="text-uppercase">
                                                            {{ $j->jenis }}</option>
                                                    @endif
                                                @endforeach
                                                <option value="jenis_other">Lainyaa ...</option>
                                            </select>
                                            <span class="input-group-text"><i class="fa fa-exchange"
                                                    aria-hidden="true"></i></span>
                                        </div>
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



                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Merk Barang</label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" name="merk_id" id="merk">
                                                <option value="" selected>Merk barang ..</option>
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

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tipe Barang</label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" name="tipe_id" id="tipe">
                                                <option value="" selected>Tipe barang ..</option>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="tipe_other" style="display:none;">
                                        <label for="other" class="text-capitalize">Tipe Barang Lainnya</label>
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
                            <script>
                                $(document).ready(function() {
                                    $("#jenis").change(function() {
                                        if ($(this).val() === 'jenis_other') {
                                            $("#jenis_other").show();
                                        } else {
                                            $("#jenis_other").hide();
                                        }
                                    });
                                    $("#merk").change(function() {
                                        if ($(this).val() === 'merk_other') {
                                            $("#merk_other").show();
                                        } else {
                                            $("#merk_other").hide();
                                        }
                                    });
                                    $("#tipe").change(function() {
                                        if ($(this).val() == 'tipe_other') {
                                            $("#tipe_other").show();
                                        } else {
                                            $("#tipe_other").hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-primary">Save</button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    {{-- <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script> --}}
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    {{-- <script src="../assets/js/plugins/chartjs.min.js"></script> --}}
    <!--  Notifications Plugin    -->
    {{-- <script src="../assets/js/plugins/bootstrap-notify.js"></script> --}}
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="{{ asset('assets/js/paper-dashboard.min.js') }}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! --> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('./assets/demo/demo.js') }}"></script>
    
@endsection
