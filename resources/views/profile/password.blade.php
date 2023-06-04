@extends('template.main')

@section('content')
    <style>
        main{
            justify-content: center;
            align-items: center;
        }
        #profile-form-edit *{
            font-size: 16px;
        }
        #profile-form-edit{
            width: 60%;
        }
        .form-button .btn{
            width: 100%;
        }
        .form-control{
            padding: 5px;
        }
        .error{
            font-size: 10px;
            color: var(--r2);
        }
    </style>
    <x-nav-all></x-nav-all>

    <main>
        <form id="profile-form-edit" action="/profile/password" method="POST" class="form-container" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="old_password">Password</label>
                <input id="old_password" name="old_password" value="{{ old("old_password") }}" required type="password">
                @error('old_password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru</label>
                <input id="new_password" name="new_password" value="{{ old("new_password") }}" required type="password">
                @error('new_password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" value="{{ old("password_confirmation") }}" required type="password">
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-button">
                <a href="/profile" class="btn btn-danger">Batal</a>
                <button class="btn btn-main">Ubah</button>
            </div>
        </form>
    </main>

    
    @if(session()->has('error2'))
        <x-alertError2 :message="session()->get('error2')"></x-alertError2>
    @endif
@endsection
