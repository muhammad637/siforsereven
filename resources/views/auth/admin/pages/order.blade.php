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
                                                <td class="text-center"> {{ $parse($order->tanggal_order) }}
                                                    <br>{{ $parse_hour($order->created_at) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->barang->jenis->jenis . ' ' . $order->barang->merk->merk . ' ' . $order->barang->tipe->tipe }}
                                                </td>
                                                <td class="text-center">{{ $order->ruangan->nama }}</td>
                                                <td class="text-center"><a
                                                        href="https://wa.me/{{ $nohp }}/?text=SIFORSEVEN%0Auntuk : {{ $order->nama_pelapor }}%0Aservisan barang  {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }} %0Astatus masih :{{ $order->status == null ? 'pending' : $order->status }} %0Adengan keterangan status: {{ $order->pesan_status == null ? 'masih menunggu' : $order->pesan_status }} %0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}"
                                                        target="_blank" class="badge bg-info p-2"
                                                        style="color: white"><span>
                                                            {{ $order->nama_pelapor }}
                                                        </span><i class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $order->status == null ? 'pending' : $order->status }}</td>
                                                <td class="text-center">
                                                    @if ($order->pesan_status != null)
                                                        <button type="button"
                                                            class="badge bg-gradient-success btn-block mb-0 border-0"
                                                            data-toggle="modal"
                                                            data-target="#keterangan-{{ $order->id }}">
                                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                                        </button>
                                                    @else
                                                        <p class="text-sm font-weight-bold mb-0">
                                                            {{ $order->pesan_status == null ? ' - ' : $order->pesan_status }}
                                                        </p>
                                                    @endif
                                                </td>
                                                <td class="text-center"> {{ $order->pesan_kerusakan }}</td>
                                                <td class="text-center">
                                                    {{ $order->tanggal_selesai ? $parse($order->tanggal_selesai) : '-' }}
                                                </td>
                                                @if (auth()->user()->cekLevel == 'admin')
                                                    <td>

                                                        <a href="https://wa.me/{{ $nohpteknisi }}/?text=SIFORSEVEN%0Auntuk : {{ $order->user->nama }}%0Aada orderan barang {{ $order->barang->jenis->jenis }} {{ $order->barang->merk->merk }} {{ $order->barang->tipe->tipe }}%0Adengan keluhan {{ $order->pesan_kerusakan }} %0Adari ruangan {{ $order->ruangan->nama }} %0Amohon diambil di ruang IT RSUD Blambangan Banyuwangi%0Adari Admin SIFORSEVEN: {{ auth()->user()->nama }}%0ATerimakasih"
                                                            target="_blank" class="badge bg-info p-2"
                                                            style="color: white;"><span>{{ $order->user->nama }} </span> <i
                                                                class="fa fa-whatsapp fs-6" aria-hidden="true"></i> </a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="#update-{{ $order->id }}" data-toggle="modal"

                                                            class="badge bg-warning" style="color: white">edit</a>
                                                    </td>
                                                @endif
                                                @if (auth()->user()->cekLevel =='admin')
                                                <td class="text-center">
                                                    <a href="{{ route('order.print', ['order' => $order->id]) }}"
                                                        class="badge bg-success" style="color: white;" target="_blank"><i
                                                            class="fa fa-print" aria-hidden="true"></i></a>
                                                </td>
                                                @endif
                                            </tr>

                                            <div class="modal fade" id="keterangan-{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="keterangan-{{ $order->id }}Title"
                                                aria-hidden="true">
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
                                                                <div class="form-group">
                                                                    <label for="tanggal_edit"
                                                                        class="col-form-label">Terakhir diupdate</label>
                                                                    <input type="text" id="tanggal_edit"
                                                                        class="form-control"
                                                                        value="{{ $parse($order->updated_at) . ' ' . $parse_hour($order->updates_at) }}"readonly>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn bg-gradient-secondary"
                                                                data-dismiss="modal" aria-label="Close">Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- modal update order --}}
                                            <div class="modal fade" id="update-{{ $order->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="update-{{ $order->id }}-Title"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Update
                                                            </h5>
                                                        </div>
                                                        <form
                                                            action="{{ route('update.order', ['order' => $order->id]) }}"
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
                                                                                value="{{ $order->pesan_kerusakan }}"
                                                                                readonly class="form-control">
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
                                                                                class="col-form-label">Status
                                                                                Selesai</label>
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

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Pesan
                                                                                Status</label>
                                                                            <textarea name="pesan_status" id="" class="form-control"> {{ $order->pesan_status }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Tanggal
                                                                                Order</label>
                                                                            <input type="date"
                                                                                value="{{ $order->tanggal_order }}"
                                                                                name="tanggal_order" readonly
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Tanggal
                                                                                Selesai</label>
                                                                            <input type="date"
                                                                                value="{{ $order->tanggal_selesai }}"
                                                                                name="tanggal_selesai"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn bg-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
