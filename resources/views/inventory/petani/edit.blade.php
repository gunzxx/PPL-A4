@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuInventory></x-menuInventory>
        <div class="card-container">
            <form class="form-container form-update" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/inventory/update">
                @csrf
                <div class="form-group">
                    <input name="bean_type" class="@error('email') invalid @enderror" value="{{ old('bean_type') ? old('bean_type') : $inventory->bean_type }}" type="text" placeholder="Masukkan jenis kedelai">
                    @error('bean_type')
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
                    <button type="button" class="btn-danger cancel-action">Batal</button>
                    <button class="save-btn" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </main>
@endsection