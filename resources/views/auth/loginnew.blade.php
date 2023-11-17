{{-- @extends('layouts.app')
@section('title')
    Landing Page
@endsection
@section('content')
<main class="main-content mt-0">
<section>
    <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 order-md-2">
              <img src="https://svgshare.com/i/t_7.svg" alt="Image" class="img-fluid">
            </div>
            <div class="container mb-5">
                <div class="row">
                    <div class="col-1">
                        @include('layouts.navbars.guest.navbar')
                    </div>
                </div>
            </div>
            <div class="col-md-6 contents">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="mb-4">
                </div>
                    <p style="font-size: 17px; color:black;">Masukkan Username dan Password Untuk Masuk</p>
                    <form role="form
                    " method="post" action="{{ route('login.perform')}}">
                    @csrf
                    @method('post')
                  <div class="form-group first">
                    
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name ="username" id="username" value="{{old ('username') ?? ''}}">
                    @error('username') <p class="text-danger text-xs pt-1">
                        {{$message}}
                        </p>@enderror
                  </div>
                  <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="currentPassword" name="password" value="{{old('password')}}">@error('password') <p class="text-danger text-xs pt-1">{{$message}}</p>@enderror
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" name="remember" type="checkbox" id="mybutton">
                    <label class="form-check-label" for="mybutton">show password</label>
                </div>
                  <button type="submit" class="btn btn-lg btn-lg w-100 mt-4 mb-0" style="background-color: #FB6340; color:white;">Login</button>
                </form>
                
              </div>
              
            </div>
            
          </div>
        </div>
      </div>
    
</section>
</main>



@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form role="form
  " method="post" action="{{ route('login.perform')}}">
  @csrf
  @method('post')
  <div class="form-group first">
                    
    <label for="username">Username</label>
    <input type="text" class="form-control" name ="username" id="username" value="{{old ('username') ?? ''}}">
    @error('username') <p class="text-danger text-xs pt-1">
        {{$message}}
        </p>@enderror
  </div>
  <div class="form-group last mb-4">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="currentPassword" name="password" value="{{old('password')}}">@error('password') <p class="text-danger text-xs pt-1">{{$message}}</p>@enderror
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" name="remember" type="checkbox" id="mybutton">
    <label class="form-check-label" for="mybutton">show password</label>
</div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</body>
</html>