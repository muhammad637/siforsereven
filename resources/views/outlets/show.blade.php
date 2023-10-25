@extends('layouts.app')

{{-- @section('title', __('detail')) --}}
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <style>
        #mapid {
            height: 400px;
        }
    </style>
@endsection
@section('title') Lokasi
@endsection
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Otlets', 'master' => 'Map'])
    <div class="row mt-4 mx-4">
        <div class="col-md-6">
            <div class="card my-2">
                <div class="card-header">
                    <h4 class="text-uppercase">Detail</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>{{ __('name') }}</td>
                                    <td>{{ $outlet->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user') }}</td>
                                    <td>{{ $outlet->user[0]->nama }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('address') }}</td>
                                    <td>{{ $outlet->address }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('latitude') }}</td>
                                    <td>{{ $outlet->latitude }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('longitude') }}</td>
                                    <td>{{ $outlet->longitude }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @can('update', $outlet)
                        <a href="{{ route('outlets.edit', $outlet) }}" id="edit-outlet-{{ $outlet->id }}"
                            class="btn btn-warning">{{ __('edit') }}</a>
                    @endcan
                    @if (auth()->check())
                        <a href="{{ route('outlet_map.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
                    @else
                        <a href="{{ route('outlet_map.index') }}" class="btn btn-secondary">{{ __('back') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5 mx-auto">
            <div class="card mb-4 p-2 border-radius-lg">
                <div class="card-body" id="mapid" style="height:80vh;"></div>
            </div>
        </div>


    </div>
@endsection


@push('js')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>

    <script>
        var map = L.map('mapid').setView([{{ $outlet->latitude }}, {{ $outlet->longitude }}],
            {{ config('leaflet.detail_zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $outlet->latitude }}, {{ $outlet->longitude }}]).addTo(map)
            .bindPopup('{!! $outlet->map_popup_content !!}');
    </script>
@endpush
