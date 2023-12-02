@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-7 mx-auto" style="margin-top: 100px;">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}" autocomplete="on">
                        @csrf
                        <div class="mb-3" id="username">
                            <label for="Username">Username</label>
                            <input name="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" required>
                        </div>

                        <div class="mb-3" id="password">
                            <label for="Password">Password</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-dark w-100 text-uppercase" id="btn">Sign In</button>
                        <p class="sign-up mt-3">Already have an Account? <a href="{{ route('login') }}"> Log In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
