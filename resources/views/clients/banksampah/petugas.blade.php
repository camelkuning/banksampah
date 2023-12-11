@extends('layouts.dashboard')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <h5 class="card-title" style="margin-bottom: 50px;">Transaksi Sampah</h5>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Petugas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($datas as $data)
                            <tr href="/httsdgsdg">
                                <td> {{ $data->petugas_nama }} </td>
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
