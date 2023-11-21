@extends('layouts.app', ['title' => 'List Ruangan', 'title'])
@section('title') Master Ruangan
@endsection
@section('content')
<div class="main-panel">
    @include('layouts.navbars.auth.topnav', ['title' => 'List Ruangan', 'master' => 'pages'])
    <div class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">List Ruangan</h4>
                        @if (auth()->user()->cekLevel == 'admin')
                            <button type="button" class="btn bg-primary" data-bs-toggle="modal"
                                data-bs-target="#modaltambah">
                                <i class="fa fa-wrench" aria-hidden="true"></i> Tambah
                            </button>
                        @endif
                    </div>

                    <div class="card-body" style="height: 100%;">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead class=" text-secondary">
                                    <th class="text-center">Nama Ruangan</th>
                                    <th class="text-center">No Ruangan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($ruangans as $ruangan)
                                        <tr>
                                            <td class="text-center">{{ $ruangan->nama }}
                                            </td>
                                            <td class="text-center">
                                                {{ $ruangan->no_ruangan }}
                                            </td>
                                            <td class="text-center">
                                                <span
                                                class="text-center badge badge-sm {{ $ruangan->status == 'nonaktif' ? 'bg-gradient-secondary' : 'bg-gradient-success' }}">{{ $ruangan->status }}</span>
                                            </td>
                                        <td class="text-center">
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
                                       
                                       
                            <div class="modal fade" id="modaledit-{{ $ruangan->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modaledittruangan" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-capitalize" id="modaleditruangan">Form Edit
                                                ruangan</h5>
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
                                                <button type="submit" class="btn bg-primary">Save</button>
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
    <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="modaltambahLabel">Form tambah ruangan</h5>
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
                    <button type="submit" class="btn bg-primary">Save</button>
                </div>

            </form>
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
</div>
@endsection
