@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>

        <form method="POST" action="/petani/shop/update" id="form-shop" enctype="multipart/form-data">
            @csrf
            <div class="form-shop-container">
                <div class="image-form-container">
                    <div class="form-group">
                        <div id="preview-img">
                            <img src="{{ $item->getFirstMediaUrl('product') ? $item->getFirstMediaUrl('product') : "/img/shop/form/default.png" }}">
                            @error('product_img')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <label for="inv-img" class="upload-inv-img-label">Upload<input type="file" name="product_img" id="inv-img" accept="image/*"></label>
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <input class="@error('bean_type') invalid @enderror" value="{{ $item->bean_type }}" type="text" name="bean_type" id="bean_type" placeholder="Jenis kedelai" readonly>
                        @error('bean_type')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('stok') invalid @enderror" value="{{ old('stok') ? old('stok') : $item->stok }}" type="text" name="stok" id="stok" placeholder="Stok">
                        @error('stok')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('price') invalid @enderror" value="{{ old('price') ? old('price') : $item->price }}" type="text" name="price" id="price" placeholder="Harga">
                        @error('price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('no_rek ') invalid @enderror" value="{{ old('no_rek') ? old('no_rek') : $item->no_rek }}" type="text" name="no_rek" id="no_rek" placeholder="No. Rekening terbaru">
                        @error('no_rek')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="item_id" id="item_id" value="{{ $item->id }}">
                </div>
            </div>
            <div class="form-group button">
                <a class="btn-danger" href="/petani/shop/shop">Batal</a>
                <button class="save-btn" type="submit">Simpan</button>
            </div>
        </form>
    </main>

    @error('message')
        <x-alertError :message="$message"></x-alertError>
    @enderror

    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif
@endsection


@section('script')
    <script src="/js/shop/petani/shop/edit.js"></script>
@endsection