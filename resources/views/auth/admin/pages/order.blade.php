@php
    use Carbon\Carbon;
    $nohp = 1;
    $nohpteknisi = 1;
    // dd($orders)
@endphp
@extends('layouts.app', ['title' => 'Service Request', 'title'])
@section('title')
    Service Request
@endsection
@section('content')
    <div class="main-panel">
        @include('layouts.navbars.auth.topnav', ['title' => 'Service Request', 'master' => 'pages'])
        <div class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">List Order Service</h4>

                            @if (auth()->user()->cekLevel == 'admin')
                                <button type="button" class="btn bg-primary text-white fw-bold" data-toggle="modal"
                                    data-target="#modaltambah">
                                    <i class="fa fa-wrench" aria-hidden="true"></i> Request
                                </button>
                            @endif
                        </div>

                        <div class="card-body" style="height: 100%;">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead class=" text-secondary">
                                        <th class="text-center">No</th>
                                        <th class="text-center">TANGGAL ORDER</th>
                                        <th class="text-center">NAMA BARANG</th>
                                        <th class="text-center">NAMA RUANGAN</th>
                                        <th class="text-center">NAMA PELAPOR</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">PESAN SERVICE</th>
                                        <th class="text-center">KERUSAKAN</th>
                                        <th class="text-center">TANGGAL SELESAI</th>
                                        @if (auth()->user()->cekLevel == 'admin')
                                            <th class="text-center">NAMA TEKNISI</th>
                                        @else
                                            <th class="text-center">AKSI</th>
                                        @endif
                                        @if (auth()->user()->cekLevel == 'admin')
                                            <th class="text-center">PRINT</th>
                                        @endif
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaltambahLabel">Form Tambah Order</h5>
                    </div>
                    <form action="{{ route('store.order') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="teknisi_id" class="">Pilih Teknisi</label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" name="user_id" type="text">
                                                <option value="">Pilih Teknisi</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-text"><i class="fa fa-user-o"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barang_id" class="text-capitalize">Pilih Barang</label>

                                        <div class="input-group-prepend mb-4">
                                            <select class="form-control" name="barang_id" type="text">
                                                <option value="">Pilih Barang</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }}
                                                        {{ $barang->merk->merk }} {{ $barang->tipe->tipe }}</option>
                                                @endforeach
                                            </select>
                                            {{-- <span class="input-group-text"><i class="fa fa-key"
                                                    aria-hidden="true"></i></span> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barang_id" class="text-capitalize">Kerusakan Barang</label>
                                        <div class="input-group mb-4">
                                            <input class="form-control" placeholder="Tulis Kendala Disini"
                                                name="pesan_kerusakan" type="text">
                                            <span class="input-group-text"><i class="fa fa-hand-rock-o"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <label for="ruangan_id" class="text-capitalize">Nama Pelapor</label>
                                        <div class="input-group mb-4">
                                            <input class="form-control" placeholder="Nama Pelapor" name="nama_pelapor"
                                                type="text">
                                            <span class="input-group-text"><i class="fa fa-user-o"
                                                    aria-hidden="true"></i></i></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ruangan_id" class="text-capitalize">Pilih Ruangan</label>
                                        <div class="input-group mb-4">
                                            <select class="form-control" name="ruangan_id" type="text">
                                                <option value="">Pilih Ruangan</option>
                                                @foreach ($ruangans as $ruangan)
                                                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}
                                                        {{ $ruangan->no_hp }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-text"><i class="fa fa-home"
                                                    aria-hidden="true"></i></span>
                                        </div>
                                        <label for="ruangan_id" class="text-capitalize">Nomer Pelapor</label>
                                        <div class="input-group mb-4">

                                            <input class="form-control" placeholder="ex: 081xxxxxxxx" name="no_pelapor"
                                                type="number">
                                            <span class="input-group-text"><i class="fa fa-mobile"
                                                    aria-hidden="true"></i></i></span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-primary">Buat Request</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <footer class="footer footer-black  footer-white ">
            <div class="text-center">


                <div class="credits ">
                    <span class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, made with <i class="fa fa-heart heart"></i> by Student Poliwangi
                    </span>
                </div>

            </div>
        </footer>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

            $('#example').DataTable({
                processing: true,
                serverside: true,
                ajax: "{{ 'order' }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                    },
                    {
                        data: "tanggal_order",
                        name: "tanggal_order",
                    },
                    {
                        data: "barang",
                        name: "barang",
                    },
                    {
                        data: "ruangan",
                        name: "ruangan",
                    },
                    {
                        data: "hub-pelapor",
                        name: "hub-pelapor",
                    },
                    {
                        data: "tanggal_order",
                        name: "tanggal_order",
                    },
                    {
                        data: "tanggal_order",
                        name: "tanggal_order",
                    },
                    {
                        data: "pesan_kerusakan",
                        name: "pesan_kerusakan",
                    },
                    {
                        data: "tanggal_selesai",
                        name: "tanggal_selesai",
                    },
                    @if(auth()->user()->cekLevel == 'admin')
                    {
                        data: "hub-teknisi",
                        name: "hub-teknisi",
                    },
                    {
                        data: "print",
                        name: "print",
                    }
                    @else
                    {
                        data: "aksi",
                        name: "aksi",
                    }
                    @endif
                ]
            });
        });
    </script>
@endpush
