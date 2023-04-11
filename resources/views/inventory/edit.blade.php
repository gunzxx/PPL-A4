@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-inventory-menu></x-inventory-menu>
        <div class="card-container">
            <form class="form-container" method="POST" action="/pengelola/inventory/update">
                @csrf
                <div class="form-group">
                    <input name="jenis_kedelai" class="@error('email') invalid @enderror" value="{{ old('jenis_kedelai') ? old('jenis_kedelai') : $inventory->jenis_kedelai }}" type="text" placeholder="Masukkan jenis kedelai">
                    @error('jenis_kedelai')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input name="stok" class="numeric @error('email') invalid @enderror" value="{{ old('stok') ? old('stok') : $inventory->stok }}" type="text" placeholder="Masukkan stok kedelai (dalam gram)">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="inv_id" value="{{ $inventory->id }}">
                <div class="form-group button">
                    <a href="/pengelola/inventory/update" class="btn-danger">Batal</a>
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection
@section('script')
    {{-- <script src="/js/pengelola.js"></script> --}}
@endsection