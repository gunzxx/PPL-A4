@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            @if ($items->count()<1)
                <div class="">
                    <p align="center">Tidak ada kedelai.</p>
                    <p align="center">Silahkan minta petani menjual kedelai terlebih dahulu.</p>
                </div>
            @else
                @foreach ($items as $item)
                    <div class="list-card">
                        <div class="list-card-img" style="background-image: url({{ $item->getFirstMediaUrl('product') != '' ? $item->getFirstMediaUrl('product') : '/img/shop/default.png' }});">
                            {{-- <img src="{{ $item->getFirstMediaUrl('product') != '' ? $item->getFirstMediaUrl('product') : '/img/shop/default.png' }}"> --}}
                        </div>
                        <div class="list-card-nonimg">
                            <div class="list-card-body">
                                <div class="list-card-detail-container">
                                    <div class="list-card-detail">
                                        <p>Jenis Kedelai : {{ ucwords($item->bean_type) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Stok : {{ ucwords($item->stok) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Harga : {{ ucwords($item->price) }}</p>
                                    </div>
                                </div>
                                <div class="list-card-time">
                                    <p>{{ date('d M Y',strtotime($item->created_at)) }}</p>
                                </div>
                            </div>
                            <div class="list-card-footer">
                                <input type="number" class="amount" value="1" min="1">
                                <button class="btn main-btn cart-btn" type="button" data-item-id="{{ $item->id }}">Tambahkan ke keranjang</button>
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
    <script src="/js/shop/pengelola/pembelian/index.js"></script>
@endsection