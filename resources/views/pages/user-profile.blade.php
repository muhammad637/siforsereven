@extends('layouts.app', ['title' => 'Profile', 'title'])
@section('title')
    user
@endsection
@section('content')
<div class="main-panel" style="height: 100vh;">
    <div class="content">
        @include('layouts.navbars.auth.topnav', ['title' => 'profile', 'master' => 'pages'])

        <section class="section profile font-poppins py-lg-5 px-md-2 overflow-hidden">
            <div class="ps-md-3">
                <div class="row">
                    <div class="col-md-3 pt-3">
                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <div class="rounded-circle">
                                    <i class="fa fa-user-circle text-dark " style="font-size: 500%;"></i>
                                </div>
                                <h2 class="text-dark my-3 text-capitalize" style="font-size: 30px;">{{ auth()->user()->nama }}</h2>
                                <p class="text-uppercase" style="font-size: 22px;">{{ auth()->user()->cekLevel }}</p>
                                <div class="social-links mt-0">
                                    <a href="#" class="facebook"><i class="fa fa-facebook-square text-dark"></i></a>
                                    <a href="#" class="instagram"><i class="fa fa-whatsapp text-dark"></i></a>
                                    <a href="#" class="linkedin"><i class="fa fa-linkedin-square text-dark"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-xl-8 col-md-3 pt-3">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">
    
                                    <li class="nav-item">
                                        <button class="nav-link active" data-toggle="tab"
                                            data-target="#profile-overview">Profile</button>
                                    </li>
    
                                    <li class="nav-item">
                                        <button class="nav-link" data-toggle="tab" data-target="#profile-edit">Edit
                                            Profile</button>
                                    </li>
    
    
                                    <li class="nav-item">
                                        <button class="nav-link" data-toggle="tab"
                                            data-target="#profile-change-password">Ubah
                                            Password</button>
                                    </li>
    
                                </ul>
                                <div class="tab-content pt-2">
    
                                    <div class="tab-pane fade show active profile-overview py-2" id="profile-overview">
                                        <h5 class="card-title">Detail Profile</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label py-2">Nama</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->nama }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label py-2">Username</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->username }} </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label py-2">Status</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->status }}</div>
                                        </div>
                                        {{-- <div class="row">
                        <div class="col-lg-3 col-md-4 label">Level</div>
                        <div class="col-lg-9 col-md-8">{{ auth()->user()->cekLevel }}</div>
                      </div> --}}
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">No Telephone</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->no_telephone }}</div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
    
                                        <!-- Profile Edit Form -->
                                        <form action="{{ route('profile.update', ['user' => auth()->user()->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="username" type="text" class="form-control" id="username"
                                                        value="{{ auth()->user()->username }}" readonly disabled>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama
                                                    Lengkap</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="nama" type="text" class="form-control" id="nama"
                                                        value="{{ auth()->user()->nama }} "
                                                        @if (auth()->user()->cekLevel == 'user') readonly disabled @endif>
                                                </div>
                                            </div>
    
                                            <div class="row mb-3">
                                                <label for="no_telephone" class="col-md-4 col-lg-3 col-form-label">No.Telp /
                                                    WA</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="no_telephone" type="text" class="form-control"
                                                        id="no_telephone" value="{{ auth()->user()->no_telephone }}">
                                                </div>
                                            </div>
    
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->
    
                                    </div>
                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form action="{{ route('profile.resetPassword', ['user' => auth()->user()->id]) }}"
                                            method="POST">
                                            @csrf
    
                                            
                                           
                                            <div class="row mb-3">
                                                <label for="currentPassword" class="col-md-5 col-lg-4 col-form-label">Password
                                                    Lama</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="password" id="currentPassword" class="d-block form-control"
                                                             name="old_password">
                                                        <span class="border rounded-md px-1 pt-2 input-group-text" id="mybutton">
                                                            <i class="fa fa-eye" id="eye1"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-5 col-lg-4 col-form-label">Password
                                                    Baru</label>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="password" id="newPassword" class="d-block form-control"
                                                             name="password">
                                                        <span class="border rounded-md px-1 pt-2" id="mybutton2">
                                                            <i class="fa fa-eye" id="eye"></i>
                                                        </span>
                                                    </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
        
                                            <div class="row mb-3">
                                                <label for="confirmPassword" class="col-md-5 col-lg-4 col-form-label">Konfirmasi
                                                    Password</label>
                                                <div class="col-md-7">
                                                    <div class="d-flex justify-content-start input-group">
                                                        <input type="password" id="confirmPassword" class="d-block form-control"
                                                             name="password_confirmation">
                                                        <div class="border rounded-md px-1 pt-2" id="mybutton3">
                                                            <i class="fa fa-eye" id="eye2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>
                                        </form>
                                        <!-- End Change Password Form -->
    
                                    </div>
    
                                </div><!-- End Bordered Tabs -->
    
                            </div>
                        </div>
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            @if (session()->has('toast_error'))
                                <div class="alert alert-danger">
                                    {{ session('toast_error') }}
                                </div>
                            @endif
    
                        </div>
                    </div>
    
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
