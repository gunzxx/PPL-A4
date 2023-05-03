@extends('template.main')

@section('content')
    <div class="main login">
        <div class="card-container">
            @error('gagal')
                <x-alertError :message="$message"></x-alertError>
            @enderror

            @if (session()->has('success'))
                <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
            @endif
            
            <div class="title-login-container">
                <p class="title-login">Selamat datang kembali</p>
                <h1 class="subtitle-login">Masuk dengan akunmu</h1>
            </div>
            <form method="POST" action="/login" class="form-container login-required-form">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input autofocus value="{{ old("email") }}" type="email" name="email" id="email" placeholder="Masukkan email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input value="{{ old("password") }}" type="password" name="password" id="password" placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <button type="submit">Masuk</button>
                </div>
                <div class="form-group text">
                    <p>Belum punya akun? <a style="color: blue;" href="/register">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="js/login.js"></script>
@endsection