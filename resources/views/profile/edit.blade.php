@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <form id="profile-form-edit" action="/profile/edit" method="POST" class="form-container" enctype="multipart/form-data">
            @csrf
            <div class="form-content">
                <div class="form-preview-container">
                    <div id="preview-img">
                        <img src="{{ auth()->user()->getFirstMediaUrl('profile') != "" ? auth()->user()->getFirstMediaUrl('profile') : '/img/profile/default.png' }}" alt="">
                    </div>
                    <label id="change-profile-label" for="change-profile"><input name="profile_image" type="file" id="change-profile" accept="image/*" style="display: none;">Unggah</label>
                </div>
                <div class="form-group-container">
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input id="fullname" name="fullname" value="{{ auth()->user()->fullname }}" type="text" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="id_number">No Identitas</label>
                        <input id="id_number" name="id_number" value="{{ auth()->user()->id_number }}" type="text" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" readonly name="email" value="{{ auth()->user()->email }}" type="text" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input id="address" name="address" value="{{ auth()->user()->address }}" type="text" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number_phone">No Telepon</label>
                        <div class="form-control-phone">
                            <span class="phone-format">+62</span>
                            <input id="number_phone" name="number_phone" type="text" required class="form-control" value="{{ str_replace('+62','',auth()->user()->number_phone) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-button">
                <a href="/profile" class="btn btn-danger">Batal</a>
                <button class="btn btn-main">Simpan</button>
            </div>
        </form>
    </main>
@endsection

@section('script')
    <script src="/js/profile/edit.js"></script>
@endsection