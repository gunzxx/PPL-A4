@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>

        <div class="box-container">
            <form action="/petani/shop/delivery/send" method="POST" id="proof-form-container" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="profile-container">
                        <div class="proof-profile-image-container bg-transparent-img">
                            <img src="{{ $delivery->petani->getFirstMediaUrl('profile') != "" ? $delivery->petani->getFirstMediaUrl('profile') : '/img/profile/default.png' }}" alt="">
                        </div>
                    </div>
                    <div class="detail-container">
                        <h1>{{ ucwords($delivery->pengelola->fullname) }}</h1>
                        <p>Alamat : {{ $delivery->pengelola->address }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div id="preview-img">
                        <img src="{{ $delivery->getFirstMediaUrl('delivery_proof') != '' ? $delivery->getFirstMediaUrl('delivery_proof') : '/img/shop/form/default.png' }}" alt="Bukti pengiriman">
                    </div>
                    @error('proof')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @if ($delivery->status != "accept")
                        <label class="proof-upload" for="input-preview-img">Unggah</label>
                        <input type="file" title="Unggah bukti pengiriman" name="proof" id="input-preview-img" accept="image/*">
                    @endif
                </div>
                <div class="form-group">
                    @if ($delivery->status != "accept")
                        <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
                        <div class="action-container">
                            <a class="btn cancel-btn" href="/petani/shop/delivery">Batal</a>
                            <button class="btn main-btn">Kirim</button>
                        </div>
                    @else
                        <span class="btn success-banner">Bukti pengiriman diterima&nbsp;<i class="bi bi-patch-check-fill"></i></span>
                    @endif
                </div>
            </form>
        </div>
    </main>

    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif
@endsection

@section('script')
    <script src="/js/shop/petani/delivery/form.js"></script>
@endsection