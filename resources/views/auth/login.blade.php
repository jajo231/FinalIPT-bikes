@extends('base')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header text-center bg-teal-800 text-white">
                    <h1>Login Page</h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url('/register') }}" class="btn btn-teal">Sign up</a>
                            <button type="submit" class="btn btn-teal">Login</button>
                        </div>
                        @method('POST')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
