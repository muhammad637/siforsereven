@extends('layouts.app', ['title' => 'User Management', 'title'])
@section('title') User Management
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User', 'master' => 'Master'])
    <div class="main-panel">
        @include('layouts.navbars.auth.topnav', ['title' => 'User Management', 'master' => 'pages'])
        <div class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">List User</h4>
                            @if (auth()->user()->cekLevel == 'admin')
                                <button type="button" class="btn bg-primary" data-toggle="modal"
                                    data-target="#modaltambah">
                                    <i class="fa fa-wrench" aria-hidden="true"></i> Tambah
                                </button>
                            @endif
                        </div>

                        <div class="card-body" style="height: 100%;">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead class=" text-secondary">
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Level</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">No Hp</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                    @if ($user->id !== auth()->user()->id)
                                            <tr>
                                                <td class="text-center"> {{ $user->nama }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $user->username }}
                                                </td>
                                                <td class="text-center">{{ $user->cekLevel }}</td>
                                                <td class="text-center">
                                                    {{ $user->nik }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $user->no_telephone }}</td>
                                                <td class="text-center" style="color:white;">
                                                    <span
                                                    class="badge badge-sm {{ $user->status == 'nonaktif' ? 'bg-secondary' : 'bg-success' }}">{{ $user->status }}</span>
                                                </td>
                                                @if ($user->outlets_id == null)
                                                <td class="text-center"> - </td>
                                            @else
                                                <td class="text-center text-sm">{{ $user->outlets->address }}</td>
                                            @endif
                                            
                                      
                                            <td>
                                                <a href="#modalEdit-{{ $user->id }}" data-toggle="modal"
                                                    class="badge bg-warning" style="color: white">edit</a>
                                                    @if ($user->status == 'aktif')
                                                        <a href="{{ route('user.nonaktif', ['user' => $user->id]) }}"
                                                            class="badge bg-danger" style="color: white">
                                                            <i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                                    @else
                                                        <a href="{{ route('user.aktif', ['user' => $user->id]) }}"
                                                            class="badge bg-success " style="color: white"><i class="fa fa-check-circle-o"
                                                                aria-hidden="true"></i></a>
                                                    @endif
                                            </td>
                                            </tr>
                                           
                                            <div class="modal fade" id="modalEdit-{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modaleditLabel">Form edit User</h5>
                                                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button> --}}
                                                        </div>
                                                        <form action="{{ route('user.update', ['user' => $user->id]) }}"
                                                            method="post">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="username">Username</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="Username" name="username"
                                                                                    type="text"
                                                                                    value="{{ $user->username }}">
                                                                                <span class="input-group-text">@</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="password">Password</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="Password" name="password"
                                                                                    type="password"
                                                                                    id="current_password-{{ $user->id }}">
                                                                                <span class="input-group-text"
                                                                                    id="myButton-{{ $user->id }}">
                                                                                    <i class="fa fa-eye" id="eye-{{ $user->id }}"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Nama</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control" placeholder="Nama"
                                                                                    name="nama" type="text"
                                                                                    value="{{ $user->nama }}">
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-user"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nik">Nomer Induk
                                                                                Kependudukan</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control" placeholder="NIK"
                                                                                    name="nik" type="text"
                                                                                    value="{{ $user->nik }}">
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-id-card"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
    
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">No Hp</label>
                                                                            <div class="input-group mb-4">
                                                                                <input class="form-control"
                                                                                    placeholder="no hp" name="no_telephone"
                                                                                    type="text"
                                                                                    value="{{ $user->no_telephone }}">
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-mobile"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="cekLevel">Level</label>
                                                                            <div class="input-group mb-4">
                                                                                <select class="form-control"
                                                                                   
                                                                                    name="cekLevel">
    
                                                                                    <option value="admin"
                                                                                        {{ $user->cekLevel == 'admin' ? 'selected' : '' }}>
                                                                                        admin</option>
                                                                                    <option value="teknisi"
                                                                                        {{ $user->cekLevel == 'teknisi' ? 'selected' : '' }}>
                                                                                        teknisi</option>
    
                                                                                </select>
                                                                                <span class="input-group-text"><i
                                                                                        class="fa fa-user-secret"
                                                                                        aria-hidden="true"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn bg-primary">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    // password
                                                    $('#eye-{{ $user->id }}').addClass('fa fa-eye-slash')
                                                    $('#myButton-{{ $user->id }}').click(function() {
                                                        // alert('oke')
                                                        // $('#currentPassword').attr('value','aan')
                                                        var passwordInputan = $('#current_password-{{ $user->id }}');
                                                        var passwordFieldTypean = passwordInputan.attr('type');
    
                                                        // Toggle tampilan password
                                                        if (passwordFieldTypean === 'password') {
                                                            passwordInputan.attr('type', 'text');
                                                            $('#eye-{{ $user->id }}').removeClass('fa fa-eye-slash')
                                                            $('#eye-{{ $user->id }}').addClass('fa fa-eye')
                                                        } else {
                                                            $('#eye-{{ $user->id }}').removeClass('fa fa-eye')
                                                            $('#eye-{{ $user->id }}').addClass('fa fa-eye-slash')
                                                            passwordInputan.attr('type', 'password');
                                                        }
                                                    });
                                                });
                                            </script>
                                            @endif
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
                    <h5 class="modal-title" id="modaltambahLabel">Form tambah User</h5>
                    
                </div>
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username_store">Username</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Username" name="username"
                                            id="username_store" type="text">
                                        <span class="input-group-text" for="username_store">@</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Password" name="password"
                                            type="password" id="currentPassword">
                                            <span class="input-group-text"><i class="fa fa-eye"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="Nama" name="nama" type="text">
                                        <span class="input-group-text"><i class="fa fa-user"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">Nomor Induk Kependudukan</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="NIK" name="nik" type="text">
                                        <span class="input-group-text"><i class="fa fa-id-card"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No Hp</label>
                                    <div class="input-group mb-4">
                                        <input class="form-control" placeholder="no hp" name="no_telephone"
                                            type="text">
                                        <span class="input-group-text"><i class="fa fa-mobile"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cekLevel">Level</label>
                                    <div class="input-group mb-4">
                                        <select class="form-control"  name="cekLevel">
                                            <option value="admin">admin</option>
                                            <option value="teknisi">teknisi</option>
                                        </select>
                                        <span class="input-group-text"><i class="fa fa-user-secret"
                                                aria-hidden="true"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-primary">Submit</button>
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
