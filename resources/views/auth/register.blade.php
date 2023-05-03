@extends('template.main')

@section('content')
    <div class="main register">
        <div class="card-container">
            <div class="title-login-container">
                <p class="title-login">Selamat datang</p>
                <h1 class="subtitle-login">Daftarkan diri anda</h1>
            </div>
            <form action="/register" method="POST" class="form-container required-form register-form">
                @csrf
                <div class="role-group">
                    <p>Daftar sebagai</p>
                    <div class="select-role">
                        <label class="role-button" for="petani"><input required type="radio" checked name="role" id="petani" value="petani">Petani</label>
                        <label class="role-button role-2" for="pengelola"><input required type="radio" name="role" id="pengelola" value="pengelola">Pengelola</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fullname">Nama lengkap</label>
                    <input value="{{ old('fullname') }}" type="text" name="fullname" id="fullname" placeholder="Masukkan nama anda" class="@error('fullname') invalid @enderror">
                    @error('fullname')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_number">Nomor identitas (Cth: NIK)</label>
                    <input value="{{ old('id_number') }}" type="text" name="id_number" id="id_number" placeholder="Masukkan nomor identitas" maxlength="20" pattern="[0-9]+" class="@error('id_number') invalid @enderror">
                    @error('id_number')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="number_phone">No HP</label>
                    <input value="{{ old('number_phone') }}" type="tel" name="number_phone" id="number_phone" placeholder="Masukkan nomor hp" maxlength="15" class="@error('number_phone') invalid @enderror">
                    @error('number_phone')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input value="{{ old('address') }}" type="text" name="address" id="address" placeholder="Masukkan alamat" class="@error('address') invalid @enderror">
                    @error('address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{ old('email') }}" type="email" name="email" id="email" placeholder="Masukkan email" class="@error('email') invalid @enderror">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input value="{{ old('password') }}" type="password" name="password" id="password" placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <button class="submit-register" type="submit">Daftar</button>
                </div>
                <div class="form-group text">
                    <p>Sudah punya akun? <a style="color: blue;" href="/login">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <div class="popup-backdrop register-popup">
        <div class="popup-container">
            <div class="popup-text">Apakah data sesuai?</div>
            <div class="popup-alert">
                <button value="true" class="popup-confirm popup-yes popup-yes-register" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="js/login.js"></script>
    <script src="js/register.js"></script>
@endsection