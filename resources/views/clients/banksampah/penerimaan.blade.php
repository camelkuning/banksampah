@extends('layouts.dashboard')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h5 class="card-title" style="margin-bottom: 50px;">Penerimaan Sampah</h5>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Berat Sampah</th>
                                <th scope="col">Jenis Sampah</th>
                                <th scope="col">Lokasi Pembuangan</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
