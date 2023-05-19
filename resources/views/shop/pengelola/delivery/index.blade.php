@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            @if ($deliveries->count()<1)
                <div>
                    <p align="center">Tidak ada data.</p>
                </div>
            @else
                @foreach ($deliveries as $delivery)
                    <div class="list-card">
                        <div class="list-card-img" style="background-image: url('{{ $delivery->transaction->item->getFirstMediaUrl('product') != '' ? $delivery->transaction->item->getFirstMediaUrl('product') : '/img/shop/default.png' }}');">
                        </div>
                        <div class="list-card-nonimg">
                            <div class="list-card-body">
                                <div class="list-card-detail-container">
                                    <div class="list-card-detail">
                                        <p>Jenis Kedelai : {{ ucwords($delivery->transaction->bean_type) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Jumlah : <span class="stok">{{ ucwords($delivery->transaction->amount) }}</span> kg</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Total harga : Rp. {{ number_format($delivery->transaction->price,0,',','.') }},-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Alamat : {{ $delivery->transaction->pengelola->address }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        @if ($delivery->status == 'notsend')
                                            <span class="status notprocess">Belum dikirim</span>
                                        @elseif($delivery->status == 'waiting')
                                            <span class="status waiting">Belum diterima</span>
                                        @elseif($delivery->status == 'accept')
                                            <span class="status accept">Diterima</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="list-card-time">
                                    <p>{{ date('d M Y',strtotime($delivery->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="list-card-footer">
                                <a class="btn warning-btn" target="_blank" href="https://wa.me/{{ $delivery->petani->number_phone }}">Hubungi petani</a>
                                @if ($delivery->status != 'notsend')
                                    <a class="btn second-warning-btn" href="/pengelola/shop/delivery/{{ $delivery->id }}">Bukti pengiriman</a>
                                @endif
                                @if ($delivery->status == 'waiting')
                                    <button class="btn main-btn accept-btn" type="button" data-delivery-id="{{ $delivery->id }}">Terima</button>
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
    <script defer src="/js/shop/pengelola/delivery/index.js"></script>
@endsection