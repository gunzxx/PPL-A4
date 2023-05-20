@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <div class="card-container">
            <form class="form-container" id="form-inventory" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/inventory/update" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div id="preview-inv-img">
                        <img src="{{ $inventory->getFirstMediaUrl('inv_img') != '' ? $inventory->getFirstMediaUrl('inv_img') : '/img/inventory/default.png' }}">
                        @error('inv_img')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="inv-img" class="upload-inv-img-label">Upload<input type="file" name="inv_img" id="inv-img" accept="image/*"></label>
                </div>
                <div class="form-group">
                    <input name="bean_type" class="@error('email') invalid @enderror" value="{{ old('bean_type') ? old('bean_type') : $inventory->bean_type }}" type="text" placeholder="Masukkan jenis kedelai">
                    @error('bean_type')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input name="stok" class="@error('email') invalid @enderror" value="{{ old('stok') ? old('stok') : $inventory->stok }}" type="text" placeholder="Masukkan stok kedelai (dalam gram)">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="inv_id" value="{{ $inventory->id }}">
                <div class="form-group button">
                    <a class="btn-danger" href="/petani/inventory/inventory">Batal</a>
                    <button class="save-btn" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </main>

    <div class="popup-backdrop cek-update">
        <div class="popup-container">
            <div class="popup-text">Apakah data sudah sesuai?</div>
            <div class="popup-alert">
                <button value="true" class="popup-confirm popup-yes popup-yes-update" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no popup-no-update" type="button">No</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/js/inventory/index.js"></script>
    <script src="/js/inventory/pengelola/manage.js"></script>
@endsection