@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            <form action="/pengelola/shop/payment/pay" method="POST" id="proof-form-container" enctype="multipart/form-data">
                @csrf
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
                    @error('proof')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @if ($payment->status != "accept")
                        <label class="proof-upload" for="input-preview-img">Unggah</label>
                        <input type="file" title="Unggah bukti pembayaran" name="proof" id="input-preview-img" accept="image/*">
                    @endif
                </div>
                <div class="form-group">
                    @if ($payment->status != "accept")
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <div class="action-container">
                            <a class="btn cancel-btn" href="/pengelola/shop/payment">Batal</a>
                            <button class="btn main-btn">Kirim</button>
                        </div>
                    @else
                        <span class="btn success-banner">Bukti pembayaran diterima&nbsp;<i class="bi bi-patch-check-fill"></i></span>
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
    <script src="/js/shop/pengelola/payment/form.js"></script>
@endsection