@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title')
    Service Request
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User', 'master' => 'pages'])
    <div class="container-fluid py-4">
        {{-- <div class="row mt-4 mx-4"> --}}
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>List Service Request</h5>
                @if (auth()->user()->cekLevel == 'admin')
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modaltambah">
                        <i class="ni ni-settings text-sm opacity-10"></i> Request
                    </button>
                @endif
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Order
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Barang</th>
                                   
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Ruangan</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Pelapor</th>
                                 
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
                                    @else
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                        </th>
                                    @endif
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Print
                                        </th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        // $i += $order->jumlah_order;
                                        $nohp = $order->no_pelapor;
                                        if (substr(trim($nohp), 0, 1) == '0') {
                                            $nohp = '62' . substr(trim($nohp), 1);
                                        }
                                        $nohpteknisi = $order->user->no_telephone;
                                        if (substr(trim($nohpteknisi), 0, 1) == '0') {
                                            $nohpteknisi = '62' . substr(trim($nohpteknisi), 1);
                                        }
                                        // $array = json_decode($order->pesan, true);
                                    @endphp
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $parse($order->tanggal_order) }} <br>{{ $parse_hour($order->created_at) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                            </p>
                                        </td>
                                       
                                            <td class="text-sm font-weight-bold mb-0">
                                                {{ $order->ruangan->nama }}</td>
                                            <td class="text-sm font-weight-bold mb-0">
                                                <a href="https://wa.me/{{ $nohp }}/?text=SIFORSEVEN%0Auntuk : {{ $order->nama_pelapor }}%0Aservisan barang  {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }} %0Astatus masih :{{ $order->status == null ? 'pending' : $order->status }} %0Adengan keterangan status: {{ $order->pesan_status == null ? 'masih menunggu' : $order->pesan_status }} %0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}"
                                                    target="_blank"
                                                    class="badge bg-info p-2"><span> {{ $order->nama_pelapor }}
                                                    </span> <i class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                            </td>
                                     
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $order->status == null ? 'pending' : $order->status }}</p>
                                        </td>
                                        <td>
                                            @if ($order->pesan_status != null)
                                                <button type="button"
                                                    class="badge bg-gradient-success btn-block mb-0 border-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#keterangan-{{ $order->id }}">
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

                                                <a href="https://wa.me/{{ $nohpteknisi }}/?text=SIFORSEVEN%0Auntuk : {{ $order->user->nama }}%0Aada orderan barang {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }}%0Adengan keluhan {{$order->pesan_kerusakan}} %0Adari ruangan {{ $order->ruangan->nama }} %0Amohon diambil di ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}%0ATerimakasih"
                                                    target="_blank"
                                                    class="badge bg-info p-2"><span>{{ $order->user->nama }} </span> <i
                                                        class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="#update-{{ $order->id }}" data-bs-toggle="modal"
                                                    class="badge bg-warning">edit</a>
                                            </td>
                                        @endif
                                            <td>
                                            <a href="{{route('order.print', ['order' => $order->id])}}" class="badge bg-success">PRINT</a>
                                            </td>
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
                                                                        class="col-form-label">Nama
                                                                        Barang</label>
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
                                                                        @if ($order->status == 'on progress')
                                                                            <option value="on progress"
                                                                                {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                                on progress</option>
                                                                            <option value="selesai"
                                                                                {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                                selesai</option>
                                                                        @else
                                                                            <option value=""
                                                                                {{ $order->status == '' ? 'selected' : '' }}>
                                                                                pending</option>
                                                                            <option value="on progress"
                                                                                {{ $order->status == 'on progress' ? 'selected' : '' }}>
                                                                                on progress</option>
                                                                            <option value="selesai"
                                                                                {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                                                                selesai</option>
                                                                        @endif
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
                                                                            Pilih Status Selesai</option>
                                                                        <option value="rusak berat"
                                                                            {{ $order->status_selesai == 'Rusak Berat' ? 'selected' : '' }}>
                                                                            Rusak Berat</option>
                                                                        <option value="selesai"
                                                                            {{ $order->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                            Bisa Dipakai</option>
                                                                        {{-- <option value=""
                                                                            {{ $order->status_selesai == '' ? 'selected' : '' }}>
                                                                            Pilih Status Selesai</option>
                                                                        <option value="rusak berat"
                                                                            {{ $order->status_selesai == 'rusak berat' ? 'selected' : '' }}>
                                                                            tidak bisa diperbaiki</option>
                                                                        <option value="selesai"
                                                                            {{ $order->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                            sudah bisa digunakan</option> --}}
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
                                                                        value="{{ $order->tanggal_order }}"
                                                                        name="tanggal_order" readonly
                                                                        class="form-control">
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

    </div>
    <div class="" style="height:100vh;"></div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaltambahLabel">Form Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('store.order') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id" class="text-capitalize">pilih teknisi</label>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="barang_id" class="text-capitalize">pilih Barang</label>
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="barang_id" type="text">
                                            <option value="">Pilih Barang</option>
                                            @foreach ($barangs as $barang)
                                                <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }}
                                                    {{ $barang->merk->merk }} {{ $barang->tipe->tipe }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-key"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pesan_kerusakan" class="text-capitalize">kerusakan barang</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Tulis Kendala Disini"
                                            name="pesan_kerusakan" id="pesan_kerusakan" type="text" value="">
                                        <span class="input-group-text"><i class="fa fa-hand-rock-o"
                                                aria-hidden="true"></i></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ruangan_id" class="text-capitalize">Pilih Ruangan</label>
                                    <div class="input-group mb-4">
                                        <select class="form-control" name="ruangan_id" type="text" id="ruangan_id">
                                            <option value="">Pilih Ruangan</option>
                                            @foreach ($ruangans as $ruangan)
                                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}
                                                    {{ $ruangan->no_hp }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-home"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pelapor" class="text-capitalize">Nama Pelapor</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="nama pelapor" name="nama_pelapor"
                                            id="nama_pelapor" type="text" value="">
                                        <span class="input-group-text"><i class="fa fa-user-o"
                                                aria-hidden="true"></i></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_pelapor" class="text-capitalize">No Handphone Pelapor</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="ex: 081xxxxxxxx" name="no_pelapor"
                                            id="no_pelapor" type="text" value="">
                                        <span class="input-group-text"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">tutup</button>
                        <button type="submit" class="btn bg-warning text-capitalize ">buat request</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
