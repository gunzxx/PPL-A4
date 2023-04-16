@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <form class="search-partner" method="POST" action="/pengelola/partners/create">
            @csrf
            <div class="form-group">
                <input autofocus value="{{ old('name') }}" required name="name" type="text" class="input-area name @error('name') invalid @enderror" placeholder="Masukkan judul kerja sama">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <textarea required name="description" class="input-area desc" placeholder="Deskripsikan kerja sama anda" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>

            <div class="input-row mb-3">
                <div class="input-col">
                    <input value="{{ old('stok') }}" required class="input-area numeric @error('stok') invalid @enderror" type="text" name="stok" id="stok" placeholder="Kisaran stok kedelai dalam gram">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-col">
                    <input value="{{ old('harga') }}" required class="input-area numeric @error('harga') invalid @enderror" type="text" name="harga" id="harga" placeholder="Harga kedelai per kilogram">
                    @error('harga')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <input type="text" value="{{ old('alamat') }}" name="alamat" placeholder="Masukkan alamat" required>
            </div>

            <div class="button-row my-5">
                <button type="button" class="cancel-action btn-danger">Batal</button>
                <button type="submit" class="save-btn">Simpan</button>
            </div>
        </form>

    </main>
@endsection