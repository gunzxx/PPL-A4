@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            @if ($payments->count()<1)
                <div>
                    <p align="center">Tidak ada data.</p>
                </div>
            @else
                @foreach ($payments as $payment)
                    <div class="list-card">
                        <div class="list-card-img" style="background-image: url('{{ $payment->transaction->item->getFirstMediaUrl('product') != '' ? $payment->getFirstMediaUrl('product') : '/img/shop/default.png' }}');">
                        </div>
                        <div class="list-card-nonimg">
                            <div class="list-card-body">
                                <div class="list-card-detail-container">
                                    <div class="list-card-detail">
                                        <p>Jenis Kedelai : {{ ucwords($payment->transaction->bean_type) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Jumlah : <span class="stok">{{ ucwords($payment->transaction->amount) }}</span> kg</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Total harga : Rp. {{ number_format($payment->transaction->price,0,',','.') }},-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Alamat : {{ $payment->transaction->pengelola->address }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        @if ($payment->status == 'notpay')
                                            <span class="status notprocess">Belum bayar</span>
                                        @elseif($payment->status == 'waiting')
                                            <span class="status waiting">Belum diterima</span>
                                        @elseif($payment->status == 'accept')
                                            <span class="status accept">Diterima</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="list-card-time">
                                    <p>{{ date('d M Y',strtotime($payment->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="list-card-footer">
                                <a class="btn second-warning-btn" href="/pengelola/shop/payment/pay/{{ $payment->id }}">Bukti pembayaran</a>
                                @if ($payment->status == 'waiting')
                                    <button class="btn main-btn accept-btn" type="button" data-payment-id="{{ $payment->id }}">Terima</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
    <script defer src="/js/shop/petani/payment/index.js"></script>
@endsection