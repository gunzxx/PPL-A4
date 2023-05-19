@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            <div id="proof-form-container">
                <div class="form-group">
                    <div class="profile-container">
                        <div class="proof-profile-image-container bg-transparent-img">
                            <img src="{{ $delivery->petani->getFirstMediaUrl('profile') != "" ? $delivery->petani->getFirstMediaUrl('profile') : '/img/profile/default.png' }}" alt="">
                        </div>
                    </div>
                    <div class="detail-container">
                        <h1>{{ ucwords($delivery->petani->fullname) }}</h1>
                        <p>No. Rek : {{ $delivery->transaction->item->no_rek }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div id="preview-img">
                        <img src="{{ $delivery->getFirstMediaUrl('delivery_proof') != '' ? $delivery->getFirstMediaUrl('delivery_proof') : '/img/shop/form/default.png' }}" alt="Bukti pengiriman">
                    </div>
                </div>
                <div class="form-group">
                    @if ($delivery->status == "accept")
                        <span class="btn success-banner">Bukti pengiriman diterima&nbsp;<i class="bi bi-patch-check-fill"></i></span>
                    @endif
                </div>
            </div>
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
    <script src="/js/shop/pengelola/payment/form.js"></script>
@endsection