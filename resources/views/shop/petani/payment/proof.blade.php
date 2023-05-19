@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>

        <div class="box-container">
            <div id="proof-form-container>
                <div class="form-group">
                    <div class="profile-container">
                        <div class="proof-profile-image-container bg-transparent-img">
                            <img src="{{ $payment->petani->getFirstMediaUrl('profile') != "" ? $payment->petani->getFirstMediaUrl('profile') : '/img/profile/default.png' }}" alt="">
                        </div>
                    </div>
                    <div class="detail-container">
                        <h1>{{ ucwords($payment->petani->fullname) }}</h1>
                        <p>No. Rek : {{ $payment->transaction->item->no_rek }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div id="preview-img">
                        <img src="{{ $payment->getFirstMediaUrl('payment_proof') != '' ? $payment->getFirstMediaUrl('payment_proof') : '/img/shop/form/default.png' }}" alt="Bukti pembayaran">
                    </div>
                </div>
                <div class="form-group">
                    @if ($payment->status == "accept")
                        <span class="btn success-banner">Bukti pembayaran diterima&nbsp;<i class="bi bi-patch-check-fill"></i></span>
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