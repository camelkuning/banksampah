@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-5 mx-auto" style="margin-top: 100px;">
                <div class="border border-dark shadow-lg bg-body rounded">
                    <div class="card">
                        <div class="card-header border-dark">{{ __('Login') }}</div>
                        <div class="card-body border-dark">
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3 " id="email">
                                    <label for="email">Email</label>
                                    <input name="email" type="email"
                                        class="border-dark form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukan Email" required>
                                </div>

                                <div class="mb-3" id="password">
                                    <label for="Password">Password</label>
                                    <input name="password" type="password"
                                        class="border-dark form-control @error('password') is-invalid @enderror"
                                        placeholder="********" required>
                                </div>


                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="border border-info btn btn-md btn-success w-25"
                                        id="btn">Sign
                                        In</button>
                                </div>

                                <p class="sign-up mt-3">Belum Punya Akun? <a href="{{ route('register') }}">Sign Up</a></p>
                            </form>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 " id="email">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="border-dark form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" required>
                            </div>

                            <div class="mb-3" id="password">
                                <label for="Password">Password</label>
                                <input name="password" type="password" class="border-dark form-control @error('password') is-invalid @enderror" placeholder="********" required>
                            </div>


                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="border border-info btn btn-md btn-success w-25"
                                    id="btn">Sign
                                    In</button>
                            </div>

                            <p class="sign-up mt-3">Belum Punya Akun? <a href="{{ route('register') }}">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
