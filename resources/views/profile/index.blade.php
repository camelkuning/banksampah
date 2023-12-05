@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif

            <div class="card" style="margin-top: 25px;">
                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="on">
                        @csrf
                        <div class="mb-3" id="username">
                            <label for="Username">Username</label>
                            <input name="username" type="text"
                                class=" border border-dark form-control @error('username') is-invalid @enderror"
                                value="{{ Auth::user()->username }}" required>
                        </div>

                        <div class="mb-3" id="Email">
                            <label for="Email">Email</label>
                            <input name="email" type="email"
                                class=" border border-dark form-control @error('email') is-invalid @enderror"
                                value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="mb-3" id="Alamat">
                            <label for="Alamat">Alamat</label>
                            <input name="alamat" type="text"
                                class=" border border-dark form-control @error('alamat') is-invalid @enderror"
                                value="{{ Auth::user()->alamat }}">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3" id="password">
                                    <label for="Password">Password</label>
                                    <input name="password" type="password" placeholder="********"
                                        class="form-control @error('message') is-invalid @enderror" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3" id="password2">
                                    <label for="Password">Re-Type Password</label>
                                    <input name="password_confirmation" type="password" placeholder="********"
                                        class="form-control @error('message') is-invalid @enderror" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="border border-info btn btn-md btn-success w-25" id="btn">
                            Update
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
