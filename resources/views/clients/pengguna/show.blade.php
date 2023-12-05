@extends('layouts.dashboard')

@push('js')
<script
    src="https://www.paypal.com/sdk/js?client-id=Af-vtJZYBT7qM7loVdbLsDNSvAtQmnkSr0FcgzXAkBAMbkMPNnxvBhHP-2yUrWAhE6rBGTCEG3eHOir2&currency=USD">
</script>
<script>
    paypal.Buttons({
         createOrder: function(data, actions) {
            return fetch('{{ route("pay.create") }}', {
                method: 'POST',
                body:JSON.stringify({
                    'bank_id': "{{ $data->id }}",
                    'user_id' : "{{ auth()->user()->id }}",
                    'amount' : "10.00",
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },

        onApprove: function(data, actions) {
            return fetch('{{ route("pay.capture") }}' , {
                method: 'POST',
                body :JSON.stringify({
                    orderId : data.orderID,
                    payment_gateway_id: $("#payapalId").val(),
                    bank_id: "{{ $data->id }}",
                    user_id: "{{ auth()->user()->id }}",
                })
            }).then(function(res) {
                return res.json();
            }).then(function(orderData) {
                var transaction = orderData.purchase_units[0].payments.captures[0];
                iziToast.success({
                    title: 'Success',
                    message: 'Payment completed',
                    position: 'topRight'
                });
            });
        }
    }).render('#paypal-button-container');
</script>
@endpush

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
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
            @if ($data->status == "belum")
            <div id="paypal-button-container"></div>
            @else
            <a class="btn btn-primary" href="{{ route('pay.invoice', $data->transaksi->payment_gateway_id) }}"
                role="button">Link</a>
            @endif
        </div>
    </div>
</div>
@endsection
