@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title') Dashboard
@endsection
@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'dashboard', 'master' => 'home'])
    <div class="container-fluid py-4">
        <div class="row">
	@if(auth()->user()->cekLevel == "admin")
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold ms-2">Jumlah Barang</p>
                                    <h5 class="font-weight-bolder ms-2">
                                       {{ $jumlahBarang}}
                                    </h5>
                                    <p class="mb-0 btn btn-success text-uppercase">
                                        unit
                                     </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		@else

<div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold ms-2">Jumlah Barang</p>
                                    <h5 class="font-weight-bolder ms-2">
                                       {{ $orderPending}}
                                    </h5>
                                    <p class="mb-0 btn btn-danger text-uppercase">
                                        pending
                                     </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endif


            <div class="@if(auth()->user()->cekLevel == "admin") col-xl-4 @else col-xl-6 @endif col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">service</p>
                                    <h5 class="font-weight-bolder">
                                        {{$orderOnprogress}}
                                    </h5>
                                    <p class="mb-0 btn btn-warning text-uppercase">
                                       on progress
                                    </p>
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@if(auth()->user()->cekLevel == "admin")
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Teknisi</p>
                                    <h5 class="font-weight-bolder">
                                        {{$users->count()}}
                                    </h5>
                                    <p class="mb-0 btn btn-info text-uppercase">
                                        orang
                                     </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        

        {{-- table --}}


        <div class="row my-4">
            <div class="col-lg-12 mb-lg-0 mb-4 text-uppercase">
                <div class="card p-2">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">list servisan terakhir</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Order
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Barang</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pesan
                                        Service</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Kerusakan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Selesai
                                    </th>
                                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Aksi
                                    </th> --}}
                                    @if (auth()->user()->cekLevel == 'admin')
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Teknisi</th>
                                    @endif
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        // $i += $order->jumlah_order;
                                        $nohp = $order->ruangan->no_hp;
                                        if (substr(trim($nohp), 0, 1) == '0') {
                                            $nohp = '62' . substr(trim($nohp), 1);
                                        }
                                        // $array = json_decode($order->pesan, true);
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $parse($order->tanggal_order) }} <br>{{$parse_hour($order->created_at)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->status == null ? 'pending' : $order->status }}</p>
                                        </td>
                                        <td>
                                            @if ($order->pesan_status != null)
                                                <button type="button"
                                                    class="badge bg-gradient-success btn-block mb-0 border-0"
                                                    data-bs-toggle="modal" data-bs-target="#keterangan-{{ $order->id }}">
                                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                                </button>
                                            @else
                                                <p class="text-sm font-weight-bold mb-0">
                                                    {{ $order->pesan_status == null ? ' - ' : $order->pesan_status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $order->pesan_kerusakan }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->tanggal_selesai ? $parse($order->tanggal_selesai) : '-' }}</p>
                                        </td>
                                       
                                        @if (auth()->user()->cekLevel == 'admin')
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $order->user->nama }}</h6>
                                                    </div>
                                                </div>

                                            </td>
                                        @endif
                                    </tr>

                                    <!-- Modal Pesan Status  -->
                                    <div class="modal fade" id="keterangan-{{ $order->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="keterangan-{{ $order->id }}Title"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Keterangan
                                                        Status
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Nama
                                                                Teknisi:</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $order->user->nama }}" readonly
                                                                id="recipient-name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Keterangan
                                                                Status</label>
                                                            <textarea class="form-control" id="message-text" readonly value="{{ $order->pesan_status }}">{{ $order->pesan_status }}</textarea>
                                                        </div>
<div class="form-group">
                                                            <label for="tanggal_edit" class="col-form-label">Terakhir diupdate</label>
                                                            <input type="text" id="tanggal_edit" class="form-control" value="{{$parse($order->updated_at).' '.$parse_hour($order->updates_at) }}"readonly></input>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- modal update order --}}
                                    <div class="modal fade" id="update-{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="update-{{ $order->id }}-Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Update
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('update.order', ['order' => $order->id]) }}"
                                                    method="post">
                                                    <div class="modal-body">

                                                        @method('put')
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Nama Barang</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}"
                                                                        readonly id="recipient-name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Kerusakan</label>
                                                                    <input type="text" name=""
                                                                        value="{{ $order->pesan_kerusakan }}" readonly
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Status</label>
                                                                    <select name="status"
                                                                        id="status-{{ $order->id }}"
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ $order->status == '' ? 'selected' : '' }}>
                                                                            pending</option>
                                                                        <option value="on progress"
                                                                            {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                            on progress</option>
                                                                        <option value="selesai"
                                                                            {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                            selesai</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div id="status_selesai-{{ $order->id }}"
                                                                    class="form-group"
                                                                    style="display:{{ $order->status_selesai ? '' : 'none;' }}">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Status Selesai</label>
                                                                    <select name="status_selesai" id=""
                                                                        class="form-control">
                                                                        <option value=""
                                                                            {{ $order->status_selesai == '' ? 'selected' : '' }}>
                                                                            notselected</option>
                                                                        <option value="tidak bisa diperbaiki"
                                                                            {{ $order->status_selesai == 'rusak berat' ? 'selected' : '' }}>
                                                                            tidak bisa diperbaiki</option>
                                                                        <option value="sudah bisa digunakan"
                                                                            {{ $order->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                            sudah bisa digunakan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="message-text" class="col-form-label">Pesan
                                                                        Status</label>
                                                                    <textarea name="pesan_status" id="" class="form-control"> {{ $order->pesan_status }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Tanggal Order</label>
                                                                    <input type="date"
                                                                        value="{{ $order->created_at }}"
                                                                        name="tanggal_order" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Tanggal Selesai</label>
                                                                    <input type="date"
                                                                        value="{{ $order->tanggal_selesai }}"
                                                                        name="tanggal_selesai" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- script form --}}
                                    <script>
                                        $(document).ready(function() {
                                            $("#status-{{ $order->id }}").change(function() {
                                                // alert($(this).val())
                                                if ($(this).val() == 'selesai') {
                                                    $("#status_selesai-{{ $order->id }}").show();
                                                    // alert('oke')
                                                } else {
                                                    $("#status_selesai-{{ $order->id }}").hide();
                                                    // alert("not oke {{ $order->id }}")
                                                }
                                            });
                                        });
                                    </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>


        @include('layouts.footers.auth.footer')
    </div>
    <div class="" style="height:80vh;"></div>
@endsection
