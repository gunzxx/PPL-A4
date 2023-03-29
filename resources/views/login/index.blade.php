@extends('template.main')

@section('container')
    <div class="auth-container">
        <div class="card-container">
            <form method="POST" class="form-container" action="/login">
                @csrf
                <h1>Masuk</h1>
                @if(session()->has('error'))
                    <div class="alert-container">
                        <p class="alert static">Login gagal</p>
                        <button type="button" class="closeAlert">X</button>
                    </div>
                @endif
                <div class="form-group">
                    <label for="username">Username</label>
                    <input required type="text" autofocus name="username" id="username" autocomplete="off" placeholder="Masukkan username" value="{{ old('username') }}">
                    @error('username')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                    <label for="password">Password</label>
                    <input required type="text" name="password" id="password" autocomplete="off" placeholder="Masukkan password" value="{{ old('password') }}">
                    @error('password')
                        <small class="error">{{ $message }}</small>
                    @enderror
                </div>
                
                <button class="login-button">Masuk</button>
                
                <div class="action-container">
                    <a href="/forgot">Lupa password</a>
                    <p>Tidak punya akun? <a href="/register">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection