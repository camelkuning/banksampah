@extends('layouts.dashboard')

@section('content')
<div class="content p-4 w-75">


    <style type="text/css">
        body{
            font-family: roboto;
        }

        table{
            margin: 0px auto;
        }
        </style>


        <center>
            <h2>Grafik Pembuangan Sampah<br/>SIBASAM</h2>
        </center>



        <div style="width: 800px;margin: 0px auto;">
            <canvas id="myChart"></canvas>
        </div>

        <br/>
        <br/>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Sampah</th>
                    <th>Lokasi Pembuangan</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


        <script>

        </script>

    </div>
</div>

@endsection
