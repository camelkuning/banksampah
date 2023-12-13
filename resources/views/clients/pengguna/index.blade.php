@extends('layouts.dashboard')

@push('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<style>
    #map {
        width: 100%;
        height: 400px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 25px;">

            @if (session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title mb-3">
                        Your current location
                    </h3>
                    <div id="map"></div>
                    <script>
                        var userLat = 0;
                        var userLon = 0;
                        var map = L.map('map').setView([0, 0], 30);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);

                        navigator.geolocation.getCurrentPosition(function(position) {
                            userLat = position.coords.latitude;
                            userLon = position.coords.longitude;

                            map.setView([userLat, userLon], 18);

                            var userLocation = L.marker([userLat, userLon]).addTo(map);
                            userLocation.bindPopup('You are here!').openPopup();
                        });
                    </script>
                </div>
            </div>

            <div class="container px-4 mx-auto">
                <div class="p-6 m-20 bg-white rounded shadow">
                    {!! $chart->container() !!}
                </div>
            </div>

            <script src="{{ $chart->cdn() }}"></script>
            {{ $chart->script() }}

        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });
</script>
@endpush
