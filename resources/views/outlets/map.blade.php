@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <style>
        #mapid {
            min-height: 500px;
        }
    </style>
@endsection
@section('title')
    Lokasi
@endsection
@section('content')
<div class="main-panel">
    <div class="content">
    @if (auth()->user()->cekLevel == 'admin')
        @include('layouts.navbars.auth.topnav', ['title' => 'Otlets', 'master' => 'Map'])
    @else
        @include('layouts.navbars.auth.topnav', ['title' => 'Lokasi', 'master' => 'Map'])
    @endif
    <div class="row mt-4 mx-4">
        @if (auth()->user()->cekLevel == 'admin')
            <div class="col-md-12">
                <div class="card mb-4 p-2">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 class="px-4 pt-5">List Outlet</h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-responsive" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Outlet</th>
                                            <th>Alamat</th>
                        
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outlets as $outlet)
                                            <tr class="text-capitalize">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-sm font-weight-bold mb-0">{!! $outlet->name_link !!}</td>
                                                <td class="text-sm font-weight-bold mb-0">{{ $outlet->address }}</td>
                                               
                                                <td class="text-center">
                                                    <a href="{{ route('outlets.show', $outlet) }}"
                                                        id="show-outlet-{{ $outlet->id }}"
                                                        class="badge bg-warning">Show</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                        <div class="col-md-7 mx-auto">
                            <div class="card-body" id="mapid" style="height:80vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="card mb-4 p-2">
                    <div class="card-header">
                        <h4 class="px-md-4">Lokasi RSUD Blambangan</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ">
                            <ul class="list-group ms-md-4 my-2">
                                <li class="list-group-item text-sm mb-0">
                                    <strong> Alamat:</strong> Jl. Letkol Istiqlah No.49, Singonegaran, Kec.
                                    Banyuwangi, Kabupaten Banyuwangi, Jawa
                                    Timur 68415
                                </li>

                                <li class="list-group-item text-sm  mb-0"><strong>Telepon:</strong> (0333) 421118</li>
                                <li class="list-group-item text-sm  mb-0"> <strong>Provinsi:</strong> Jawa Timur</li>
                                <li class="list-group-item text-sm  mb-0 text-capitalize"> <strong>jam operaisonal:</strong>
                                    <hr>
                                    <p class="text-sm"><strong>Senin</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Selasa</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Rabu</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Kamis</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Jumat</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Sabtu</strong>
                                        07.00–21.00
                                    </p>
                                        <p class="text-sm"><strong>Minggu</strong>
                                            Libur
                                        </p>
                                </li>

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-7 mx-auto">
                            <div class="card-body" id="mapid" style="height:60vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif




    </div>
    </div>
</div>
    {{-- @if (auth()->user()->cekLevel == 'admin')
        @include('layouts.navbars.auth.topnav', ['title' => 'Otlets', 'master' => 'Map'])
    @else
        @include('layouts.navbars.auth.topnav', ['title' => 'Lokasi', 'master' => 'Map'])
    @endif
    <div class="row mt-4 mx-4">
        @if (auth()->user()->cekLevel == 'admin')
            <div class="col-md-12">
                <div class="card mb-4 p-2">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 class="px-4 pt-5">List Outlet</h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-responsive" id="myTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama Outlet</th>
                                            <th>Alamat</th>
                        
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outlets as $outlet)
                                            <tr class="text-capitalize">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-sm font-weight-bold mb-0">{!! $outlet->name_link !!}</td>
                                                <td class="text-sm font-weight-bold mb-0">{{ $outlet->address }}</td>
                                               
                                                <td class="text-center">
                                                    <a href="{{ route('outlets.show', $outlet) }}"
                                                        id="show-outlet-{{ $outlet->id }}"
                                                        class="badge bg-warning">Show</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                
                        <div class="col-md-7 mx-auto">
                            <div class="card-body" id="mapid" style="height:80vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="card mb-4 p-2">
                    <div class="card-header">
                        <h4 class="px-md-4">Lokasi RSUD Blambangan</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ">
                            <ul class="list-group ms-md-4 my-2">
                                <li class="list-group-item text-sm mb-0">
                                    <strong> Alamat:</strong> Jl. Letkol Istiqlah No.49, Singonegaran, Kec.
                                    Banyuwangi, Kabupaten Banyuwangi, Jawa
                                    Timur 68415
                                </li>

                                <li class="list-group-item text-sm  mb-0"><strong>Telepon:</strong> (0333) 421118</li>
                                <li class="list-group-item text-sm  mb-0"> <strong>Provinsi:</strong> Jawa Timur</li>
                                <li class="list-group-item text-sm  mb-0 text-capitalize"> <strong>jam operaisonal:</strong>
                                    <hr>
                                    <p class="text-sm"><strong>Senin</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Selasa</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Rabu</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Kamis</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Jumat</strong>
                                        07.00–21.00
                                    </p>
                                    <p class="text-sm"><strong>Sabtu</strong>
                                        07.00–21.00
                                    </p>
                                        <p class="text-sm"><strong>Minggu</strong>
                                            Libur
                                        </p>
                                </li>

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-7 mx-auto">
                            <div class="card-body" id="mapid" style="height:60vh;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif




    </div> --}}
@endsection
@push('js')
    <script>
        alert('oke')
    </script>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    {{-- <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>

    <script>
        @if (auth()->user()->cekLevel == 'admin')
            var map = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
                {{ config('leaflet.map_center_longitude') }}
            ], {{ config('leaflet.zoom_level') }});
            var baseUrl = "{{ url('/') }}";

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-8.208604611624, 114.36582023133]).addTo(map)
                .bindPopup(
                    'RSUD BLAMBANGAN.<br> Jl. Letkol Istiqlah No.49, Singonegaran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68415.'
                )
                .openPopup();

            axios.get('{{ route('api.outlets.index.lain') }}')
                .then(function(response) {
                    @if (auth()->user()->cekLevel == 'admin')
                        console.log(response.data);
                    @endif
                    L.geoJSON(response.data, {
                            pointToLayer: function(geoJsonPoint, latlng) {
                                return L.marker(latlng);
                            }
                        })
                        .bindPopup(function(layer) {
                            return layer.feature.properties.map_popup_content;
                        }).addTo(map);
                })
                .catch(function(error) {
                    console.log(error);
                });

            @can('create', new App\Models\Outlet())
                var theMarker;
                map.on('click', function(e) {
                    let latitude = e.latlng.lat.toString().substring(0, 15);
                    let longitude = e.latlng.lng.toString().substring(0, 15);

                    if (theMarker != undefined) {
                        map.removeLayer(theMarker);
                    };

                    var popupContent = "Your location : " + latitude + ", " + longitude + ".";
                    popupContent += '<br><a href="{{ route('outlets.create') }}?latitude=' + latitude +
                        '&longitude=' +
                        longitude + '">Add new outlet here</a>';

                    theMarker = L.marker([latitude, longitude]).addTo(map);
                    theMarker.bindPopup(popupContent)
                        .openPopup();
                });
            @endcan
        @else
            var map_rsud = L.map('mapid').setView([{{ config('leaflet.map_center_latitude') }},
                {{ config('leaflet.map_center_longitude') }}
            ], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map_rsud);

            L.marker([-8.208604611624, 114.36582023133]).addTo(map_rsud)
                .bindPopup(
                    'RSUD BLAMBANGAN.<br> Jl. Letkol Istiqlah No.49, Singonegaran, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68415.'
                )
                .openPopup();
        @endif
    </script> --}}
@endpush
