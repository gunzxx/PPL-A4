@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            @if ($carts->count()<1)
                <div class="">
                    <p align="center">Tidak ada barang di keranjang.</p>
                </div>
            @else
                @foreach ($carts as $cart)
                    <div class="list-card">
                        <div class="list-card-img" style="background-image: url({{ $cart->item->getFirstMediaUrl('product') != '' ? $cart->item->getFirstMediaUrl('product') : '/img/shop/default.png' }});">
                            {{-- <img src="{{ $cart->getFirstMediaUrl('product') != '' ? $cart->getFirstMediaUrl('product') : '/img/shop/default.png' }}"> --}}
                        </div>
                        <div class="list-card-nonimg">
                            <div class="list-card-body">
                                <div class="list-card-detail-container">
                                    <div class="list-card-detail">
                                        <p>Jenis Kedelai : {{ ucwords($cart->item->bean_type) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Harga : Rp. <span class="cost">{{ number_format($cart->item->price,0,',','.') }}</span>,-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p class="amount-text">Jumlah : <input type="number" class="amount amount-form" value="{{ ucwords($cart->amount) }}" min="1"></p>
                                    </div>
                                </div>
                                <div class="list-card-time">
                                    <p>{{ date('d M Y',strtotime($cart->updated_at)) }}</p>
                                </div>
                            </div>
                            <div class="list-card-thigh">
                                <p>Total harga : Rp. <span class="total_cost">{{ number_format(($cart->item->price * $cart->amount),0,',','.') }}</span>,-</p>
                            </div>
                            <div class="list-card-footer">
                                <button class="btn update-btn" type="button" data-cart-id="{{ $cart->id }}">Update <i class="bi bi-pencil-square"></i></button>
                                <button class="btn delete-btn" type="button" data-cart-id="{{ $cart->id }}">Hapus <i class="bi bi-trash3-fill"></i></button>
                                <button class="btn main-btn buy-btn" type="button" data-cart-id="{{ $cart->id }}"  data-item-id="{{ $cart->item->id }}">Beli</button>
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
    <script src="/js/shop/pengelola/main.js"></script>
    <script src="/js/shop/pengelola/cart/index.js"></script>
@endsection