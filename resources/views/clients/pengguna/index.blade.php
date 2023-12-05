@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12" style="margin-top: 25px;">
            @if (session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
            @endif
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
</script>
@endpush
