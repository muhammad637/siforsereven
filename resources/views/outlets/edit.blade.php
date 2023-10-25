@extends('layouts.app')

{{-- @section('title', __('edit')) --}}
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />

    <style>
        #mapid {
            height: 50px;
        }
    </style>
@endsection
@section('title') Lokasi Edit
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit', 'master' => 'Outlet'])
    <div class="row mt-4 mx-4">
        <div class="col-md-7">
            @if (request('action') == 'delete' && $outlet)
                @can('delete', $outlet)
                    <div class="card mb-4">
                        <div class="card-header text-uppercase fw-bold">{{ __('delete') }}</div>
                        <div class="card-body text-capitalize">
                            <label class="control-label text-primary">{{ __('name') }}</label>
                            <p class="ps-1 fw-bold">{{ $outlet->name }}</p>
                            <label class="control-label text-primary">{{ __('address') }}</label>
                            <p class="ps-1 fw-bold">{{ $outlet->address }}</p>
                            <label class="control-label text-primary">{{ __('latitude') }}</label>
                            <p class="ps-1 fw-bold">{{ $outlet->latitude }}</p>
                            <label class="control-label text-primary">{{ __('longitude') }}</label>
                            <p class="ps-1 fw-bold">{{ $outlet->longitude }}</p>
                            {!! $errors->first('outlet_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <hr style="margin:0">
                        <div class="card-footer">
                            <form method="POST" action="{{ route('outlets.destroy', $outlet) }}" accept-charset="UTF-8"
                                onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)"
                                class="del-form float-right" style="display: inline;">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <input name="outlet_id" type="hidden" value="{{ $outlet->id }}">
                                <button type="submit" class="btn btn-danger text-uppercase">{{ __('delete') }}</button>
                            </form>
                            <a href="{{ route('outlets.edit', $outlet) }}" class="btn btn-secondary">{{ __('cancel') }}</a>
                        </div>
                    </div>
                @endcan
            @else
                <div class="card text-capitalize">
                    <div class="card-header text-uppercase fs-4 fw-bold ">{{ __('edit') }}</div>
                    <form method="POST" action="{{ route('outlets.update', $outlet) }}" accept-charset="UTF-8">
                        {{ csrf_field() }} {{ method_field('patch') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('name') }}</label>
                                <input id="name" type="text"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                    value="{{ old('name', $outlet->name) }}" required>
                                {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('name') }}</label>
                                <select name="user_id" class="form-control" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->outlet_id == $outlet->id ? 'selected' : '' }}>{{ $user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">{{ __('address') }}</label>
                                <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                    rows="4">{{ old('address', $outlet->address) }}</textarea>
                                {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="latitude" class="control-label">{{ __('latitude') }}</label>
                                        <input id="latitude" type="text"
                                            class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}"
                                            name="latitude" value="{{ old('latitude', $outlet->latitude) }}" required>
                                        {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="longitude" class="control-label">{{ __('longitude') }}</label>
                                        <input id="longitude" type="text"
                                            class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}"
                                            name="longitude" value="{{ old('longitude', $outlet->longitude) }}" required>
                                        {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <input type="submit" value="{{ __('update') }}" class="btn btn-success">
                            <a href="{{ route('outlets.show', $outlet) }}"
                                class="btn btn-secondary">{{ __('cancel') }}</a>
                            @can('delete', $outlet)
                                <a href="{{ route('outlets.edit', [$outlet, 'action' => 'delete']) }}"
                                    id="del-outlet-{{ $outlet->id }}"
                                    class="btn btn-danger float-right">{{ __('delete') }}</a>
                            @endcan
                        </div>
                    </form>
                </div>
            @endif

        </div>
        <div class="col-md-5">
            <div class="card">
                <div id="mapid" style="height:80vh;"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">

        </div>
    </div>
@endsection



@push('js')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script>
        var mapCenter = [{{ $outlet->latitude }}, {{ $outlet->longitude }}];
        var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(mapCenter).addTo(map);

        function updateMarker(lat, lng) {
            marker
                .setLatLng([lat, lng])
                .bindPopup("Your location :  " + marker.getLatLng().toString())
                .openPopup();
            return false;
        };

        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            updateMarker(latitude, longitude);
        });

        var updateMarkerByInputs = function() {
            return updateMarker($('#latitude').val(), $('#longitude').val());
        }
        $('#latitude').on('input', updateMarkerByInputs);
        $('#longitude').on('input', updateMarkerByInputs);
    </script>
@endpush
