@extends('layouts.auth')

@section('content')
    {{-- register page --}}

    <div class="d-flex justify-content-center align-items-center">
        <div class="w-100">
            <div class="card">
                <h2 class="card-header">Daftar</h2>
                <img src="{{ asset('storage/full-logo.webp') ?? asset('storage/placeholder/placeholder-img.png') }}"
                    class="card-img-top object-fit-cover" alt="..." style="max-height: 250px">
                <div class="card-body">
                    <form method="POST" action="/register">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Enter name" name="name" value="{{ old('name') }}" required
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter email" name="email" value="{{ old('email') }}" required
                                autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" placeholder="Enter password" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password-confirm"
                                placeholder="Enter confirm password" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>

                    {{-- sudah punya akun --}}
                    @if (Route::has('login'))
                        <div class="mt-3">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"> Masuk sekarang</a>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class=""><span class="material-symbols-rounded text-primary">store</span></div>
                        <div class="ms-2"><a href="/shop">Kembali ke toko</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
