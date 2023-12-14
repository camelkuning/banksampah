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
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h5 class="card-title" style="margin-bottom: 50px;">Input Buang sampah</h5>
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('pengguna.postBuangSampah') }}" autocomplete="on">
                        @csrf

                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Berat Sampah (kg)</label>
                            <input name="BeratSampah" type="number"
                                class="form-control @error('BeratSampah') is-invalid @enderror" placeholder="" required>
                        </div>

                        <div class="mb-3" id="JenisSampah">
                            <label for="JenisSampah">Jenis Sampah</label>
                            <select class="form-control" name="JenisSampah" id="JenisSampah">
                                <option disable value="Organik" selected="selected">Sampah (Organik)</option>
                                <option value="Anorganik">Sampah (Anorganik)</option>
                            </select>
                        </div>

                        <div class="mb-3" id="lokasi">
                            <label for="lokasi">Lokasi Pembuangan</label>
                            <select class="form-control" name="lokasi" id="lokasi">
                                @foreach ($lokasi as $l)
                                <option value="{{ $l->id }}">{{ $l->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="jam">
                            <label for="jam">Tgl/Jam</label>
                            <input type="datetime-local" name="jam" class="form-control">
                        </div>

                        <div class="mb-3">
                            <div id="map"></div>
                            <script>
                                var userLat = 0;
                                var userLon = 0;
                                var map = L.map('map').setView([0, 0], 30);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    maxZoom: 19,
                                }).addTo(map);

                                var iconUrls = [
                                    'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                                    'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                    'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png',
                                    'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png',
                                ];

                                var locations = <?php echo json_encode($lokasi); ?>;
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

                                    L.marker([
                                        e.lat,
                                        e.lon
                                    ], {
                                        icon: greenIcon
                                    }).addTo(map).bindPopup(e.name).openPopup();
                                });
                            </script>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success w-25 text-uppercase" id="btn">
                            Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
