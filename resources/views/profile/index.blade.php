@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div class="profile-top-container">
            <div class="img-profile">
                <img src="{{ auth()->user()->getFirstMediaUrl('profile') != "" ? auth()->user()->getFirstMediaUrl('profile') : "/img/profile/default.png" }}" alt="">
            </div>
            <div class="profile-label">
                <h3>{{ auth()->user()->fullname }}</h3>
                <p>{{ auth()->user()->getRoleNames()[0] == "pengelola" ? "Pengelola susu kedelai" : "Petani kedelai" }}</p>
                <div class="action-container">
                    <a href="/profile/edit" class="btn btn-warning">Edit <i class="bi bi-pencil-square"></i></a>
                </div>
            </div>
        </div>
        <div class="profile-bottom-container">
            <div class="profile-bottom">
                <div class="col">
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <p class="form-control">{{ auth()->user()->number_phone }}</p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <p class="form-control">{{ auth()->user()->number_phone }}</p>
                    </div>
                    <a class="btn btn-logout logout">Logout</a>
                </div>
            </div>
        </div>
    </main>
@endsection