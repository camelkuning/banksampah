@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 25px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form method="POST" action="{{ route('pengguna.langganan.create') }}">
                                @csrf
                                <input type="text" name="langganan_id" id="langganan_id" value="{{ $data->id }}" hidden>
                                <div class="mb-3" id="langganan">
                                    <label for="langganan">Langganan</label>
                                    <input name="langganan" type="text" class="form-control" value="{{ $data->name }}"
                                        readonly>
                                </div>

                                <div class="mb-3" id="harga">
                                    <label for="harga">Harga</label>
                                    <input name="harga" type="text" class="form-control"
                                        value="USD {{ number_format($data->harga,2,',','.') }}" readonly>
                                </div>

                                <div class="mb-3" id="hari">
                                    <label for="hari">Hari</label>
                                    <input name="hari" type="text" class="form-control" value="30 Hari" readonly>
                                </div>

                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="border border-info btn btn-md btn-success w-25"
                                        id="btn">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3" id="langganan">
                                <label for="langganan">Bayar</label>
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
