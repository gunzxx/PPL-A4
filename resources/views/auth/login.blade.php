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
                {{-- <div class="role-group">
                    <p>Masuk sebagai</p>
                    <div class="select-role">
                        <label class="role-button" for="petani"><input required type="radio" checked name="role" id="petani" value="petani">Petani</label>
                        <label class="role-button role-2" for="pengelola"><input required type="radio" name="role" id="pengelola" value="pengelola">Pengelola</label>
                    </div>
                </div> --}}
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email" placeholder="Masukkan nomor hp">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" name="password" id="password" placeholder="Masukkan nomor hp">
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
                <div class="form-group text">
                    <p>Belum punya akun? <a href="/register">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script src="js/login.js"></script>
@endsection