@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-7 mx-auto" style="margin-top: 100px;">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3" id="username">
                            <label for="Username">Username</label>
                            <input name="username" type="text" class="form-control @error('message') is-invalid @enderror"
                                required>
                        </div>

                        <div class="mb-3" id="email">
                            <label for="Email">Email</label>
                            <input name="email" type="email" class="form-control @error('message') is-invalid @enderror"
                                required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3" id="password">
                                    <label for="Password">Password</label>
                                    <input name="password" type="password"
                                        class="form-control @error('message') is-invalid @enderror" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3" id="password2">
                                    <label for="Password">Re-Type Password</label>
                                    <input name="password_confirmation" type="password"
                                        class="form-control @error('message') is-invalid @enderror" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="role">
                            <label for="Role">Role</label>
                            <select class="form-select" name="role" id="Role">
                                <option selected="selected" value="Pengguna">Pengguna</option>
                                <option value="BankSampah">Bank Sampah</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-lg btn-dark w-100 text-uppercase" id="btn">Sign Up</button>

                        <p class="sign-up mt-3">
                            Already have an Account? <a href="{{ route('login') }}"> Log In</a>
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
