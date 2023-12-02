@extends('layouts.dashboard')

@section('content')
<div class="content p-4 w-75">

    @if (session('flash_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Hallo <strong>{{ Auth::user()->username }} </strong> Selamat Datang
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-light">
                <div class="card-header">
                    Hallo
                </div>
                <div class="card-body">
                    Halloooaoaoa
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-light">
                <div class="card-header">
                    Hallo
                </div>
                <div class="card-body">
                    :v
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-light">
                <div class="card-header">
                    Hallo
                </div>
                <div class="card-body">
                    Halloooaoaoa
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
