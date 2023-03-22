@extends('template.main')

@section('container')
    <div class="auth-container">
        <form method="POST" class="form-container" action="/login">
            @csrf
            <h1>Login</h1>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Masukkan username">
            </div>
            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" autocomplete="off" placeholder="Masukkan password">
            </div>
            
            <button class="login-button">Login</button>
        </form>
    </div>
@endsection