@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="list-card">
            <div class="card-header-row">
                <div class="card-header-col">
                    <h1>{{ ucfirst($detail->partner->name) }}</h1>
                    <p>{{ ucfirst($detail->partner->pengelola->fullname) }}</p>
                </div>
                <div class="card-header-col end">
                    <h1>Rp {{ number_format(round($detail->partner->price,-2),0,',','.') }}</h1>
                    <p>1 kg kedelai</p>
                </div>
            </div>
            <div class="card-body">
                <p>{{ Str::limit(strip_tags($detail->partner->description),500) }}</p>
            </div>
            <div class="card-footer">
                <h3>{{ $detail->partner->pengelola->address }}</h3>
                <p>{{ date("d F Y", strtotime($detail->partner->updated_at)) }}</p>
            </div>
        </div>

        <div class="card-container">
            <form class="form-container form-update" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/offers/update">
                @csrf
                <div class="form-group">
                    <input value="{{ $detail->offer->name }}" class="form-input" required name="name" placeholder="Nama penawaran" id="name" cols="30" rows="10">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-input" required name="description" placeholder="Deskripsikan penawaran anda" id="description" cols="30" rows="10">{{ $detail->offer->description }}</textarea>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <input value="{{ $detail->offer->stok }}" class="numeric form-input @error('stok') invalid @enderror" required name="stok" class="numeric" type="text" placeholder="Range stok (kg/bulan)">
                        @error('stok')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-col">
                        <input value="{{ $detail->offer->price }}" class="numeric form-input @error('price') invalid @enderror" required name="price" class="numeric" type="text" placeholder="Harga kedelai (kg)">
                        @error('price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-col">
                        @if ($inventories->count()>0)
                            <select class="form-input @error('bean_id') invalid @enderror" required name="bean_id" id="bean_id">
                                @foreach ($inventories as $inventory)
                                    <option @if($detail->offer->bean_id == $inventory->id) selected @endif value="{{ $inventory->id }}">{{ $inventory->bean_type }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="kosong">Inventori masih kosong, harap <a href="/petani/inventory/create" class="error">tambah inventori</a></p>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="offer_id" value="{{ $detail->offer->id }}">
                <div class="form-row button">
                    <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                    <button class="save-btn" type="submit">Save Bid</button>
                </div>
            </form>
        </div>
    </main>
@endsection