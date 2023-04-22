@extends('template.main')

@section('content')
    <div class="main login">
        <div class="card-container">
            <div class="title-login-container">
                <p class="title-login">Selamat datang kembali</p>
                <h1 class="subtitle-login">Masuk dengan akunmu</h1>
            </div>
            @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('loginError') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <form method="POST" action="/login" class="form-container">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input autofocus value="{{ old("email") }}" required type="email" name="email" id="email" placeholder="Masukkan email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input value="{{ old("password") }}" required type="password" name="password" id="password" placeholder="Masukkan password">
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

    @error('gagal')
        <input type="hidden" id="login-gagal" value="{{ $message }}">
        <script>
            alert($("#login-gagal").val())
        </script>
    @enderror
@endsection


@section('script')
    <script src="js/login.js"></script>
@endsection