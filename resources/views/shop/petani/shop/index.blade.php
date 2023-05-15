@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>
        <x-createButton :url="'/petani/shop/create'"></x-createButton>

        <div class="box-container">
            @if ($items->count()<1)
                <div class="">
                    <p align="center">Tidak ada penjualan.</p>
                    <p align="center">Silahkan jual kedelai terlebih dahulu.</p>
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
                                <a href="/petani/shop/update/{{ $item->id }}" class="btn update-btn">Update <i class="bi bi-pencil-square"></i></a>
                                <button data-item-id="{{ $item->id }}" class="btn delete-btn" type="button">Hapus <i class="bi bi-trash3-fill"></i></button>
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
    <script src="/js/shop/petani/penjualan/index.js"></script>
@endsection