@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuInventory></x-menuInventory>

        <div class="card-container">
            <form class="form-container required-form" id="form-inventory" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/inventory/create" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div id="preview-inv-img">
                        <img src="/img/inventory/default.png">
                        @error('inv_img')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="inv-img" class="upload-inv-img-label">Upload<input type="file" name="inv_img" id="inv-img" accept="image/*"></label>
                </div>
                <div class="form-group">
                    <input class="@error('bean_type') invalid @enderror" value="{{ old('bean_type') }}" name="bean_type" type="text" placeholder="Masukkan jenis kedelai">
                    @error('bean_type')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="@error('stok') invalid @enderror" value="{{ old('stok') }}" name="stok" class="numeric" type="text" placeholder="Masukkan stok kedelai kg">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group button">
                    <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                    <button class="save-btn" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script src="/js/inventory/index.js"></script>
    <script src="/js/inventory/pengelola/manage.js"></script>
@endsection