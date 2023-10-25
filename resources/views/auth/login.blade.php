@extends('layouts.app')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">

                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-1">
                                @include('layouts.navbars.guest.navbar')
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto order-lg-1 order-last">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <p class="mb-0 text-dark text-sm">Masukkanqweqew username dan password
                                        untuk masuk </p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                                        @csrf
                                        @method('post')
                                        <div class="flex flex-col mb-3">
                                            <input type="text" name="username" class="form-control form-control-lg"
                                                value="{{ old('username') ?? 'admin' }}" aria-label="Username">
                                            @error('username')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg"
                                                aria-label="Password" value="secret">
                                            @error('password')
                                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-7 d-lg-flex h-100 my-auto pe-0 position-absolute top-10 end-0 text-end justify-content-end flex-column order-lg-2 order-first">
                            <div class="position-relative h-100 m-2 px-10 border-radius-lg d-flex flex-column justify-content-end "
                                style="background-image: url('https://svgshare.com/i/t_7.svg');
                                  background-size: contain; width:90%; height:60%; background-repeat: no-repeat; right:-10%">

                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                          <div class="col order-last">
                            First in DOM, ordered last
                          </div>
                          <div class="col">
                            Second in DOM, unordered
                          </div>
                          <div class="col order-first">
                            Third in DOM, ordered first
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </section>
    </main>
@endsection
