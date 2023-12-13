@extends('layouts.dashboard')

@push('js')
    <script
        src="https://www.paypal.com/sdk/js?client-id=Af-vtJZYBT7qM7loVdbLsDNSvAtQmnkSr0FcgzXAkBAMbkMPNnxvBhHP-2yUrWAhE6rBGTCEG3eHOir2&currency=USD&components=buttons&enable-funding=paylater&disable-funding=venmo,card">
    </script>
    <script>
        function purchase(id) {
            //
        }
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-top: 25px;">
                @include('layouts.alert')

                @if (Auth::user()->LanggananExpire->isPast())
                    <div class="row">

                        @foreach ($datas as $data)
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="card" style="margin: 10px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $data->name }}</h5>
                                        <p class="card-text">
                                            Dengan berlangganan Anda dapat membuang sampah sepuasnya...
                                        </p>
                                        <a href="{{ route('pengguna.langganan.show', $data->id) }}" class="btn btn-warning">
                                            <i class="bi bi-cash-coin mr-2"></i>Berlangganan  
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3" id="langganan">
                                <label for="langganan">Langganan</label>
                                <input name="langganan" type="text" class="form-control" value="{{ Auth::user()->langganan->name }}"
                                    readonly>
                            </div>

                            <div class="mb-3" id="expired">
                                <label for="expired">Expired</label>
                                <input name="expired" type="datetime" class="form-control"
                                    value="{{ Auth::user()->LanggananExpire }}" readonly>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
