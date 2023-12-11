@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="margin-top: 25px;">
                <div class="card-body">
                    @include('layouts.alert')
                    <form method="POST" action="{{ route('pengguna.langganan.post') }}">
                        @csrf
                        <div class="mb-3" id="langganan">
                            <label for="langganan">Langganan</label>
                            <select class="form-control" name="langganan" id="langganan">
                                @foreach ($datas as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} - USD {{
                                    number_format($data->harga,2,',','.') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="border border-info btn btn-md btn-success w-25" id="btn">
                                Bayar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
