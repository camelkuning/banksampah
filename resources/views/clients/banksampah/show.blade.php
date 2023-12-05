@extends('layouts.dashboard')

@section('content')
<div class="container" style="margin-top: 20px; margin-bottom: 25px;">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">

            <div class="card" style="margin-bottom: 25px;">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 50px;">Data Pengguna</h5>
                    <form>
                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Username</label>
                            <input name="BeratSampah" type="text" class="form-control" value="{{ $user->username }}"
                                disabled>
                        </div>

                        <div class="mb-3" id="Email">
                            <label for="Email">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="mb-3" id="Alamat">
                            <label for="Alamat">Alamat</label>
                            <input name="alamat" type="text" class="form-control" value="{{ $user->alamat }}" disabled>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card" style="margin-bottom: 25px;">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 50px;">Data Sampah</h5>
                    <form>
                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Berat Sampah (kg)</label>
                            <input name="BeratSampah" type="text"
                                class="form-control @error('BeratSampah') is-invalid @enderror"
                                value="{{ $data->berat_sampah }}" disabled>
                        </div>

                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Jenis Sampah</label>
                            <input name="BeratSampah" type="text"
                                class="form-control @error('BeratSampah') is-invalid @enderror"
                                value="{{ $data->jenis_sampah }}" disabled>
                        </div>

                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Lokasi Pembuangan</label>
                            <input name="BeratSampah" type="text"
                                class="form-control @error('BeratSampah') is-invalid @enderror"
                                value="{{ $data->lokasi_pembuangan }}" disabled>
                        </div>

                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Status</label>
                            <input name="BeratSampah" type="text"
                                class="form-control @error('BeratSampah') is-invalid @enderror"
                                value="{{ $data->status }}" disabled>
                        </div>

                        <div class="mb-3" id="username">
                            <label for="BeratSampah">Jam</label>
                            <input name="BeratSampah" type="datetime"
                                class="form-control @error('BeratSampah') is-invalid @enderror" value="{{ $data->jam }}"
                                disabled>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <form method="POST" action="{{ route('banksampah.penerimaan.add') }}" autocomplete="on">
                @csrf
                <input name="id" type="text" class="form-control" value="{{ $data->id }}" hidden>
                <p class="d-inline-flex gap-1">
                    <button type="submit" class="btn btn-lg btn-success text-uppercase"
                    id="btn">Ambil</button>
                </p>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
