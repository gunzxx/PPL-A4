@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <form class="search-partner" method="POST" action="/pengelola/partners/partners/edit">
            @csrf
            <input type="hidden" name="partner_id" value="{{ $partner->id }}">
            <div class="form-group">
                <input autofocus value="{{ old('name')? old('name') : $partner->name }}" required name="name" type="text" class="input-area name @error('name') invalid @enderror" placeholder="Masukkan judul kerja sama">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <textarea required name="description" class="input-area desc" placeholder="Deskripsikan kerja sama anda" id="description" cols="30" rows="10">{{ old('description')? old('description') : $partner->description }}</textarea>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-row mb-3">
                <div class="input-col">
                    <input value="{{ old('stok')? old('stok') : $partner->stok }}" required class="input input-area numeric @error('stok') invalid @enderror" type="text" name="stok" id="stok" placeholder="Kisaran stok kedelai">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-col">
                    <input value="{{ old('price')? old('price') : $partner->price }}" required class="input input-area numeric @error('price') invalid @enderror" type="text" name="price" id="price" placeholder="Price kedelai">
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="input-col">
                    @if ($inventories->count()>0)
                        <select class="input @error('bean_id') invalid @enderror" required name="bean_id" id="bean_id">
                            @foreach ($inventories as $inventory)
                                <option @if($partner->bean_id == $inventory->id) selected @endif value="{{ $inventory->id }}">{{ $inventory->bean_type }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="kosong">Inventori masih kosong, harap </p>
                        <a href="/pengelola/inventory/create" class="error">tambah inventori</a>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <input type="text" readonly value="{{ $partner->pengelola->address }}" name="address" placeholder="Masukkan alamat" required>
            </div>

            <div class="button-row my-5">
                <button type="button" class="cancel-action btn-danger">Batal</button>
                <button type="submit" class="save-btn">Simpan</button>
            </div>
        </form>

    </main>
@endsection