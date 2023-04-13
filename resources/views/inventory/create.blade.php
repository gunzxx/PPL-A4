@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menu-inventory></x-menu-inventory>

        <div class="card-container">
            <form class="form-container" method="POST" action="/inventory/create">
                @csrf
                <div class="form-group">
                    <input class="@error('jenis_kedelai') invalid @enderror" value="{{ old('jenis_kedelai') }}" name="jenis_kedelai" type="text" placeholder="Masukkan jenis kedelai">
                    @error('jenis_kedelai')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="numeric @error('stok') invalid @enderror" value="{{ old('stok') }}" name="stok" class="numeric" type="text" placeholder="Masukkan stok kedelai (dalam gram)">
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