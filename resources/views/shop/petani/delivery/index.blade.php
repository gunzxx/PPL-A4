@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>

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
                                        <p>Total harga : Rp. {{ number_format($delivery->transaction->total_cost,0,',','.') }},-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Alamat : {{ $delivery->pengelola->address }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        @if ($delivery->status == 'notsend')
                                            <span class="status notprocess">Belum dikirm</span>
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
                                <a class="btn warning-btn" target="_blank" href="https://wa.me/{{ $delivery->pengelola->number_phone }}">Hubungi pengelola</a>
                                
                                @if ($delivery->status == 'notsend')
                                    <a class="btn main-btn" href="/petani/shop/delivery/send/{{ $delivery->id }}" data-payment-id="{{ $delivery->id }}">Kirim</a>
                                @elseif ($delivery->status == 'waiting')
                                    <a class="btn second-warning-btn" href="/petani/shop/delivery/send/{{ $delivery->id }}" data-payment-id="{{ $delivery->id }}">Bukti pengiriman</a>
                                @elseif($delivery->status == 'accept')
                                    <a class="btn second-warning-btn" href="/petani/shop/delivery/{{ $delivery->id }}" data-payment-id="{{ $delivery->id }}">Bukti pengiriman</a>
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
