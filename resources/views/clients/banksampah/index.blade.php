@extends('layouts.dashboard')

@push('css')
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
<div class="content p-4 w-75">
    <div class="card">
        <div id="map" class="card-img-top"></div>
        <div class="card-body">
            <h3 class="card-title mb-3">
                Lokasi Bank Sampah
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banksampah as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->lat }}</td>
                        <td>{{ $data->lon }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                var map = L.map('map').setView([0, 0], 30);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    navigator.geolocation.getCurrentPosition(function(position) {
                        var lat = position.coords.latitude;
                        var lon = position.coords.longitude;

                        map.setView([lat, lon], 18);
                        var userLocation = L.marker([lat, lon]).addTo(map);
                        userLocation.bindPopup('You are here!').openPopup();
                    });

                    var iconUrls = [
                        'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                        'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
                        'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
                    ];

                    var locations = <?php echo json_encode($banksampah); ?>;
                    locations.forEach(e => {
                        var randomIconUrl = iconUrls[Math.floor(Math.random() * iconUrls.length)];

                        var greenIcon = new L.Icon({
                            iconUrl: randomIconUrl,
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        });

                        console.log("name: " + e.name);
                        console.log("lat: " + e.lat);
                        console.log("lon: " + e.lon);

                        L.marker([
                            e.lat,
                            e.lon
                        ], {
                            icon: greenIcon
                        }).addTo(map).bindPopup(e.name).openPopup();
                    });
            </script>
        </div>
    </div>
</div>
@endsection
