<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card" style="margin-top: 25px;">
                <div class="card-body">
                    <h5 class="card-title">Perincian transaksi</h5>
                    <p class="card-text">
                        {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y | s.m.h') }} WIT
                    </p>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Status Pembayaran: Selesai</p>
                                    <br>
                                    <p>Jenis Pembayaran: Checkout</p>
                                </div>

                                <div class="col-md-6 text-end">
                                    <p>Jumlah</p>
                                    <h4>USD 15.00,-</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Perincian pesanan</th>
                                <th scope="col">Berat Sampah</th>
                                <th scope="col">Jenis Sampah</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pengambilan Sampah</td>
                                <td>{{ $bank->berat_sampah }}</td>
                                <td>{{ $bank->jenis_sampah }}</td>
                                <td>{{ $bank->lokasi_pembuangan }}</td>
                                <td>{{ $bank->jam }}</td>
                                <td>USD 15.00,-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
