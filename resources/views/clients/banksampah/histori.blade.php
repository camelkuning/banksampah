@extends('layouts.dashboard')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h5 class="card-title" style="margin-bottom: 50px;">Transaksi Sampah</h5>
            <div class="card">
                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Berat Sampah</th>
                                <th scope="col">Jenis Sampah</th>
                                <th scope="col">Lokasi Pembuangan</th>
                                <th scope="col">Hari/Tanggal | Jam</th>
                                <th scope="col">Status Terima</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datas as $data)
                            <tr href="/httsdgsdg">
                                <td> {{ $data->id }} </td>
                                <td> {{ $data->berat_sampah }} </td>
                                <td> {{ $data->jenis_sampah }} </td>
                                <td> {{ $data->lokasi_pembuangan }} </td>
                                <td>
                                    {{ Carbon\Carbon::parse($data->jam)->format('d/m/Y | h:m:s') }}
                                </td>

                                @if ($data->status == 'belum')
                                <td> <span class="badge rounded-pill bg-danger">Belum</span> </td>
                                @elseif ($data->status == 'sudah')
                                <td> <span class="badge rounded-pill bg-success">Sudah</span> </td>
                                @endif

                                @if ($data->status_terima == 0)
                                <td> <span class="badge rounded-pill bg-danger">Belum</span> </td>
                                @else
                                <td> <span class="badge rounded-pill bg-success">Sudah</span> </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
