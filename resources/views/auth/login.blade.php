@extends('layouts.auth')

@section('content')
    {{-- login page --}}

    <div class="d-flex justify-content-center align-items-center mt-5 min">
        <div class="w-100">
            {{-- alert error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- card login --}}
            <div class="card">
                <h2 class="card-header">Masuk</h2>
                <img src="{{ asset('storage/full-logo.webp') ?? asset('storage/placeholder/placeholder-img.png') }}"
                    class="card-img-top object-fit-cover" alt="..." style="max-height: 250px">
                <div class="card-body">
                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Enter email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
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
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </form>

                    {{-- dont have account --}}
                    @if (Route::has('register'))
                        <div class="mt-3">
                            Belum punya akun?
                            <a href="{{ route('register') }}"> Daftar sekarang</a>
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
