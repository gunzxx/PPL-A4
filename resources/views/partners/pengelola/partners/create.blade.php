@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <form class="form-container flex-col mt-3" method="POST" action="/pengelola/partners/partners/create">
            @csrf
            <div class="form-group">
                <input autofocus value="{{ old('name') }}" required name="name" type="text" class="input-area name @error('name') invalid @enderror" placeholder="Masukkan judul kerja sama">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <textarea required name="description" class="input-area desc" placeholder="Deskripsikan kerja sama anda" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-row">
                <div class="input-col">
                    <input value="{{ old('stok') }}" required class="input input-area numeric @error('stok') invalid @enderror" type="text" name="stok" id="stok" placeholder="Kisaran stok kedelai">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-col">
                    <input value="{{ old('price') }}" required class="input input-area numeric @error('price') invalid @enderror" type="text" name="price" id="price" placeholder="Price kedelai">
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-col">
                    <input class="input input-area @error('bean_type') invalid @enderror" required name="bean_type" id="bean_type" placeholder="Masukkan jenis kedelai">
                </div>
            </div>

            <div class="form-group">
                <input type="text" readonly value="{{ auth()->user()->address }}" name="address" placeholder="Masukkan alamat" required>
            </div>

            <div class="button-row">
                <button type="button" class="cancel-action btn-danger">Batal</button>
                <button type="submit" class="save-btn">Simpan</button>
            </div>
        </form>

    </main>
@endsection