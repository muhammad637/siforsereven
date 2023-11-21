@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app', ['title' => 'History', 'title'])
@section('title')
    History
@endsection
@section('content')
    <div class="main-panel">
        @include('layouts.navbars.auth.topnav', ['title' => 'history', 'master' => 'Pages'])
        <!-- Navbar -->

        <!-- End Navbar -->
        <div class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">HISTORY</h4>
                            <div class="dropdown">
                                <a href="#" class="btn bg-gradient-dark dropdown-toggle " data-toggle="dropdown"
                                    id="navbarDropdownMenuLink2">
                                    <i class="fa fa-arrow-circle-down" aria-hidden="true"></i> Excel
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    <li>
                                        <a href="{{ route('history.exportAll') }}" class="dropdown-item">
                                            Semua
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#laporanBulan" data-toggle="modal">
                                            Bulan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#laporanJenisBarang" data-toggle="modal">
                                            Jenis Barang
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#laporanBarang" data-toggle="modal">
                                            Barang
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            
                        </div>



                        <div class="d-flex g-2 ml-2">

                            <p class="mb-0">Tampilkan : </p>
                            <div class="grid g-2">
                                <button href="{{ route('history') }}"
                                    class="badge bg-gradient-success  mb-0 border-0 p-2">Semua</button>
                                <button type="button" class="badge bg-gradient-success  mb-0 border-0 p-2"
                                    data-toggle="modal" data-target="#historyBulan">
                                    Bulan
                                </button>
                                <button type="button" class="badge bg-gradient-success  mb-0 border-0 p-2"
                                    data-toggle="modal" data-target="#historyBarang">
                                    Barang
                                </button>
                                <button type="button" class="badge bg-gradient-success  mb-0 border-0 p-2"
                                    data-toggle="modal" data-target="#historyStatus">

                                    Status
                                </button>
                            </div>
                        </div>
                        <!-- <div class="d-md-flex d-sm-block gap-2 mb-4">
                              <p class="mb-0">Tampilkan : </p>
                              <div class="row">
                                <div class="col">testing</div>
                                <div class="col">testing</div>
                              </div>
                              <a href="{{ route('history') }}" class="badge bg-gradient-success btn-block mb-0 border-0">Semua</a>
                              <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-toggle="modal"
                                  data-target="#historyBulan">
                                  Bulan
                              </button>
                              <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-toggle="modal"
                                  data-target="#historyBarang">
                                  Barang
                              </button>
                              <button type="button" class="badge bg-gradient-success btn-block mb-0 border-0" data-toggle="modal"
                                  data-target="#historyStatus">
          
                                  Status
                              </button>
                          </div> -->

                        <div class="card-body" style="height: 100%;">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead class=" text-secondary">
                                        <th class="text-center">TANGGAL ORDER</th>
                                        <th class="text-center">NAMA BARANG</th>
                                        <th class="text-center">NAMA RUANGAN</th>
                                        @if(auth()->user()->cekLevel == 'admin')
                                        <th class="text-center">NAMA PELAPOR</th>
                                        @endif
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">KERUSAKAN</th>
                                        <th class="text-center">TANGGAL SELESAI</th>
                                        @if(auth()->user()->cekLevel == 'admin')
                                        <th class="text-center">NAMA TEKNISI</th>
                                        @else
                                        <th class="text-center">AKSI</th>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @if (session()->get('history') != 'tidak ada')
                                        @foreach ($historys as $history)
                                            @php
                                                // $i += $order->jumlah_order;
                                                $nohp = $history->no_pelapor;
                                                if (substr(trim($nohp), 0, 1) == '0') {
                                                    $nohp = '62' . substr(trim($nohp), 1);
                                                }
                                                // $array = json_decode($order->pesan, true);
                                            @endphp
                                        <tr>
                                            <td class="text-center">
                                                {{ Carbon::parse($history->tanggal_order)->format('d-M-Y') }} <br>  {{ Carbon::parse($history->created_at)->format('H:i:s') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $history->barang->jenis->jenis . ' ' . $history->barang->merk->merk . ' ' . $history->barang->tipe->tipe }}

                                            </td>
                                            <td class="text-center"> 
                                                {{ $history->ruangan->nama }}
                                            </td>
                                            @if(auth()->user()->cekLevel == 'admin')
                                            <td class="text-center">
                                                <a href="https://wa.me/{{ $nohp }}/?text=*-=INFO SERVICE=-*%0Auntuk Yth: *{{ $history->nama_pelapor }}* %0Aruangan: *{{ $history->ruangan->nama }}*%0AStatus Service dari *{{ $history->barang->jenis->jenis }} {{ $history->barang->merk->merk }} {{ $history->barang->tipe->tipe }}* {{$history->status_selesai == "selesai" ? "sudah bisa digunakan" : "tidak bisa diperbaiki/rusak berat"}}, *mohon diambil ke ruang IT RSBL.*%0ADari Petugas IT: {{ auth()->user()->nama }}, terimakasih."
                                                    target="_blank" class="badge bg-info p-2" style= "color: white;">{{ $history->nama_pelapor }}
                                                    <i class="fa fa-whatsapp fs-6" aria-hidden="true"></i></a>  
                                            </td>
                                            @endif
                                            <td class="text-center">
                                                <p
                                                    class="text-sm font-weight-bold mb-0 {{ $history->status_selesai == 'rusak berat' ? 'text-danger' : 'text-success' }}">
                                                    <i class="text-success fa fa-check-circle" aria-hidden="true"></i>
                                                    {{ $history->status_selesai == "selesai" ? "Bisa dipakai " : "rusak berat" }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <a type="button"
                                                class="badge bg-gradient-success btn-block mb-0 border-0"
                                                data-toggle="modal"
                                                data-target="#keterangan-{{ $history->id }}">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </a>
                                             <div class="modal fade" id="keterangan-{{ $history->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="keterangan-{{ $history->id }}Title"
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
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Teknisi:</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $history->user->nama }}" disable
                                                                        id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message-text"
                                                                        class="col-form-label">Keterangan
                                                                        Status</label>
                                                                    <textarea class="form-control" id="message-text" readonly value="{{ $history->pesan_status }}">{{ $history->pesan_status }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_edit" class="col-form-label">Terakhir diupdate</label>
                                                                    <input type="text" id="tanggal_edit" class="form-control" value="{{Carbon::parse($history->updated_at)->format("d-M-Y H:i:s")}}" readonly></input>
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
                                            </td>
                                            <td class="text-center">
                                                {{ $history->pesan_kerusakan }}
                                            </td>
                                            <td class="text-center">
                                                {{ Carbon::parse($history->tanggal_selesai)->format('d-M-Y') }}
                                            </td>
                                            @if(auth()->user()->cekLevel == 'admin')
                                            <td class="text-center">
                                                {{ $history->user->nama }}
                                            </td>
                                            @else
                                            <td class="text-center">
                                                <a href="#update-{{$history->id}}" data-toggle="modal"
                                                    class="badge bg-warning">edit</a>
                                            </td>
                                            @endif


                                            <div class="modal fade" id="update-{{ $history->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="update-{{ $history->id }}-Title" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Form Update
                                                            </h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('update.history', ['order' => $history->id]) }}"
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
                                                                                value="{{ $history->barang->jenis->jenis . ' ' . $history->barang->merk->merk . ' ' . $history->barang->tipe->tipe }}"
                                                                                readonly id="recipient-name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Kerusakan</label>
                                                                            <input type="text" name=""
                                                                                value="{{ $history->pesan_kerusakan }}" readonly
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
                                                                                id="status-{{ $history->id }}"
                                                                                class="form-control" readonly>
                                                                                @if ($history->status == 'on progress')
                                                                                    <option value="on progress"
                                                                                        {{ $history->status == 'on progress' ? 'selected' : '' }}>
                                                                                        on progress</option>
                                                                                    <option value="selesai"
                                                                                        {{ $history->status == 'selesai' ? 'selected' : '' }}>
                                                                                        selesai</option>
                                                                                @else
                                                                                    <option value=""
                                                                                        {{ $history->status == '' ? 'selected' : '' }}>
                                                                                        pending</option>
                                                                                    <option value="on progress"
                                                                                        {{ $history->status == 'on progress' ? 'selected' : '' }}>
                                                                                        on progress</option>
                                                                                    <option value="selesai"
                                                                                        {{ $history->status == 'selesai' ? 'selected' : '' }}>
                                                                                        selesai</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div id="status_selesai-{{ $history->id }}"
                                                                            class="form-group"
                                                                          >
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Status Selesai</label>
                                                                               
                                                                            <select name="status_selesai" id=""
                                                                                class="form-control">
        
                                                                                <option value=""
                                                                                    {{ $history->status_selesai == '' ? 'selected' : '' }}>
                                                                                    Pilih Status Selesai</option>
                                                                                <option value="rusak berat"
                                                                                    {{ $history->status_selesai == 'rusak Berat' ? 'selected' : '' }}>
                                                                                    Rusak Berat</option>
                                                                                <option value="selesai"
                                                                                    {{ $history->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                                    Bisa Dipakai</option>
                                                                                {{-- <option value=""
                                                                                    {{ $history->status_selesai == '' ? 'selected' : '' }}>
                                                                                    Pilih Status Selesai</option>
                                                                                <option value="rusak berat"
                                                                                    {{ $history->status_selesai == 'rusak berat' ? 'selected' : '' }}>
                                                                                    tidak bisa diperbaiki</option>
                                                                                <option value="selesai"
                                                                                    {{ $history->status_selesai == 'selesai' ? 'selected' : '' }}>
                                                                                    sudah bisa digunakan</option> --}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label">Pesan
                                                                                Status</label>
                                                                            <textarea name="pesan_status" id="" class="form-control"> {{ $history->pesan_status }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name"
                                                                                class="col-form-label">Tanggal Order</label>
                                                                            <input type="date"
                                                                                value="{{ $history->tanggal_order }}"
                                                                                name="tanggal_order" readonly
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="message-text"
                                                                                class="col-form-label">Tanggal Selesai</label>
                                                                            <input type="date" readonly
                                                                                value="{{ $history->tanggal_selesai }}"
                                                                                name="tanggal_selesai" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
        
        
        
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-gradient-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn bg-gradient-primary">Submit</button>
                                                            </div>
                                                        </form>
        
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="historyBulan" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan</h5>
                                </div>
                                <form action="{{ route('history.bulan') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Month</label>
                                            <input class="form-control" type="month"  id="example-month-input"
                                                name="bulan">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="historyBarang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Barang</h5>
                                </div>
                                <form action="{{ route('history.barang') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Barang</label>
                                            <select name="barang_id" id="" class="form-control">
                                                <option value="" selected>Pilih Barang ..</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }} -
                                                        {{ $barang->merk->merk }} - {{ $barang->tipe->tipe }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="historyJenisBarang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Jenis Barang</h5>
                                </div>
                                <form action="{{ route('history.jenis.barang') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Barang</label>
                                            <select name="jenis_id" id="" class="form-control">
                                                <option value="" selected>Pilih Jenis Barang ..</option>
                                                @foreach ($jenis_barangs as $jenis)
                                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="historyStatus" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">history sesusai status</h5>
                                </div>
                                <form action="{{ route('history.status') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Status</label>
                                            <select name="status_selesai" id="" class="form-control">
                                                <option value="" selected>Pilih Status ..</option>
                                                <option value="selesai">bisa dipakai</option>
                                                <option value="rusak berat">Rusak Berat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="laporanBulan" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Bulan</h5>
                                  
                                </div>
                                <form action="{{ route('history.exportBulan') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Month</label>
                                            <input class="form-control" type="month"  id="example-month-input"
                                                name="bulan">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                        data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="laporanBarang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Barang</h5>
                                  
                                </div>
                                <form action="{{ route('history.exportBarang') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Barang</label>
                                            <select name="barang_id" id="" class="form-control">
                                                <option value="" selected>Pilih Barang ..</option>
                                                @foreach ($barangs as $barang)
                                                    <option value="{{ $barang->id }}">{{ $barang->jenis->jenis }} -
                                                        {{ $barang->merk->merk }} - {{ $barang->tipe->tipe }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="laporanJenisBarang" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-capitalize" id="exampleModalLabel">pilih Jenis Barang</h5>
                                  
                                </div>
                                <form action="{{ route('history.exportJenisBarang') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="example-month-input" class="form-control-label">Jenis Barang</label>
                                            <select name="jenis_id" id="" class="form-control">
                                                <option value="" selected>Pilih Jenis Barang ..</option>
                                                @foreach ($jenis_barangs as $jenis)
                                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                    </div>
                                </form>
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
                    © <script>
                      document.write(new Date().getFullYear())
                    </script>, made with <i class="fa fa-heart heart"></i> by Student Poliwangi
                  </span>
                </div>
              
            </div>
          </footer>
       
@endsection
