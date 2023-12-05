@extends('layouts.dashboard')

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
                                <label  for="BeratSampah">Berat Sampah (kg)</label>
                                <input name="BeratSampah" type="text"
                                    class="form-control @error('BeratSampah') is-invalid @enderror" placeholder="" required>
                            </div>

                            <div class="mb-3" id="JenisSampah">
                                <label for="JenisSampah">Jenis Sampah</label>
                                <select class="form-select" name="JenisSampah" id="JenisSampah">
                                    <option disable value="Organik" selected="selected">Sampah (Organik)</option>
                                    <option value="Anorganik">Sampah (Anorganik)</option>
                                </select>
                            </div>

                            <div class="mb-3" id="lokasi">
                                <label for="lokasi">Lokasi Pembuangan</label>
                                <select class="form-select" name="lokasi" id="lokasi">
                                    <option selected="selected" value="Lokasi1">Lokasi Sampah 1</option>
                                    <option value="Lokasi2">Lokasi Sampah 2</option>
                                    <option value="Lokasi3">Lokasi Sampah 3</option>
                                </select>
                            </div>

                            <div class="mb-3" id="jam">
                                <label for="jam">Tgl/Jam</label>
                                <input type="datetime-local" name="jam" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success w-25 text-uppercase"
                                id="btn">Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
