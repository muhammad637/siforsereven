@extends('layouts.app', ['title' => 'Dashboard', 'title'])
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="main-panel">
        @include('layouts.navbars.auth.topnav', ['title' => 'dashboard', 'master' => 'home'])
        <div class="content">
            <div class="row ">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-7 col-md-8">
                                    <div class="">
                                        <p class="card-category" style="font-size: 16px;">Jumlah Barang</p>
                                        <p class="card-title" style="font-size: 2em;">{{ $jumlahBarang }}
                                        <p>
                                    </div>
                                    <div class="btn btn-success">Unit</div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-money-coins text-warning"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer ">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-7 col-md-8">
                                    <div class="">
                                        <p class="card-category" style="font-size: 16px;">Service</p>
                                        <p class="card-title" style="font-size: 2em;">{{ $orderOnprogress }}
                                        <p>
                                        <div class="btn btn-danger">On Progress</div>
                                    </div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-globe text-danger"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer ">

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-7 col-md-8">
                                    <div class="">
                                        <p class="card-category" style="font-size: 16px;">Jumlah Teknisi</p>
                                        <p class="card-title" style="font-size: 2em;">{{ $users->count() }}
                                        <p>
                                        <div class="btn btn-primary">Orang</div>
                                    </div>
                                </div>
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="nc-icon nc-single-02 text-primary"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer ">

                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List Order Service</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-secondary">
                                            <th class="text-center">TANGGAL</th>
                                            <th class="text-center">NAMA BARANG</th>
                                            <th class="text-center">STATUS</th>
                                            <th class="text-center">PESAN</th>
                                            <th class="text-center">KERUSAKAN</th>
                                            <th class="text-center">TANGGAL SELESAI</th>
                                            <th class="text-center">NAMA TEKNISI</th>
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
                                                    <td class="text-center">
                                                        {{ $parse($order->tanggal_order) }}
                                                        <br>{{ $parse_hour($order->created_at) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->status == null ? 'pending' : $order->status }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($order->pesan_status != null)
                                                            <a type="button"
                                                                class="badge bg-gradient-success btn-block mb-0 border-0"
                                                                data-toggle="modal"
                                                                data-target="#keterangan-{{ $order->id }}">
                                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <p class="text-sm font-weight-bold mb-0">
                                                                {{ $order->pesan_status == null ? ' - ' : $order->pesan_status }}
                                                            </p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->pesan_kerusakan }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->tanggal_selesai ? $parse($order->tanggal_selesai) : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->user->nama }}
                                                    </td>
                                                </tr>
                                        </tbody>
                                        <div class="modal fade" id="keterangan-{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="keterangan-modalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Keterangan
                                                            Status
                                                        </h5>
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
                                                                <label for="message-text"
                                                                    class="col-form-label">Keterangan
                                                                    Status</label>
                                                                <textarea class="form-control" id="message-text" readonly value="{{ $order->pesan_status }}">{{ $order->pesan_status }}</textarea>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
