@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPetani :active="$active"></x-menuShopPetani>

        <form method="POST" action="/petani/shop/create" id="form-shop" enctype="multipart/form-data">
            @csrf
            <div class="form-shop-container">
                <div class="image-form-container">
                    <div class="form-group">
                        <div id="preview-img">
                            <img src="/img/shop/form/default.png">
                            @error('product_img')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <label for="inv-img" class="upload-inv-img-label">Upload<input type="file" name="product_img" id="inv-img" accept="image/*"></label>
                    </div>
                </div>
                <div class="form-container">
                    <div class="form-group">
                        <input class="@error('bean_type') invalid @enderror" value="{{ $agreement_details[0]->agreement->bean_type }}" type="text" name="bean_type" id="bean_type" placeholder="Jenis kedelai" readonly>
                        @error('bean_type')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('stok') invalid @enderror" value="{{ old('stok') }}" type="text" name="stok" id="stok" placeholder="Stok">
                        @error('stok')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('price') invalid @enderror" value="{{ old('price') }}" type="text" name="price" id="price" placeholder="Harga">
                        @error('price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="@error('no_rek ') invalid @enderror" value="{{ old('no_rek') }}" type="text" name="no_rek" id="no_rek" placeholder="No. Rekening terbaru">
                        @error('no_rek')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        @if ($agreement_details->count()>0)
                            <select class="form-input @error('bean_id') invalid @enderror" name="agreement_detail_id" id="agreement_detail_id">
                                @foreach ($agreement_details as $agreement_detail)
                                    @if(session()->has("agreement_detail_id"))
                                    <option value="{{ $agreement_detail->id }}" @if(session()->get("agreement_detail_id")==$agreement_detail->id) selected @endif>{{ ucfirst($agreement_detail->petani->fullname) }} - {{ date("d F Y (H:i:s)", strtotime($agreement_detail->offer->created_at)) }}</option>
                                    @else
                                    <option value="{{ $agreement_detail->id }}">{{ ucfirst($agreement_detail->petani->fullname) }} - {{ date("d F Y (H:i:s)", strtotime($agreement_detail->agreement->created_at)) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @else
                            <p class="kosong">Tidak ada penawaran, harap <a href="/petani/inventory/create" class="error">tambah inventori</a></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group button">
                <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                <button class="save-btn" type="submit">Tambah</button>
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
    <script src="/js/shop/petani/penjualan/create.js"></script>
@endsection