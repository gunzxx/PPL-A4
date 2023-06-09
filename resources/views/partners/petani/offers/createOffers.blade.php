@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="list-card">
            <div class="card-header-row">
                <div class="card-header-col card-header-identity">
                    <h1>{{ ucfirst($partner->name) }}</h1>
                    <p>{{ ucfirst($partner->pengelola->fullname) }}</p>
                </div>
                <div class="card-header-col end">
                    <h1>Rp {{ number_format(round($partner->price,-2),0,',','.') }}</h1>
                    <p>{{ $partner->stok }} kg kedelai</p>
                </div>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <p>Jenis kedelai : {{ $partner->bean_type }}</p>
                    <p title="klik untuk menampilkan lebih lengkap" class="card-description">Deskripsi : {{ $partner->description }}</p>
                </div>
            </div>
            <div class="card-footer">
                <h3>{{ $partner->pengelola->address }}</h3>
                <p>{{ date("d F Y", strtotime($partner->updated_at)) }}</p>
            </div>
            <div class="card-action">
                <button class="btn delete batal-tawar cancel-action" data-id="{{ $partner->id }}" type="button">Batal tawar</button>
            </div>
        </div>

        <div class="card-container">
            <form id="offer-required-form" class="form-container required-form" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/offers/create">
                @csrf
                <div class="form-group">
                    <textarea class="form-input" name="description" placeholder="Deskripsikan penawaran anda" id="description" cols="30" rows="10">{{ old("description") }}</textarea>
                    @error('description')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group form-col">
                        <input value="{{ old('stok') }}" class="numeric form-input @error('stok') invalid @enderror" name="stok" class="numeric" type="text" placeholder="Range stok (kg/bulan)">
                        @error('stok')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-col">
                        <input value="{{ old('price') }}" class="numeric form-input @error('price') invalid @enderror" name="price" class="numeric" type="text" placeholder="Harga kedelai (kg)">
                        @error('price')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-col">
                        @if ($inventories->count()>0)
                            <select class="form-input @error('bean_id') invalid @enderror" name="bean_id" id="bean_id">
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->bean_type }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="kosong">Inventori masih kosong, harap <a href="/petani/inventory/create" style="color: blue;" target="_blank" class="error">tambah inventori</a></p>
                        @endif
                    </div>
                </div>
                <input type="hidden" name="partner_id" value="{{ $partner->id }}">
                <div class="form-row button">
                    <a class="btn-danger" href="/petani/home">Batal</a>
                    <button class="save-btn" type="submit">Place bid</button>
                </div>
            </form>
        </div>
    </main>

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif

    @error("duplicate")
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror
@endsection

@section('script')
    <script src="/js/partner/petani/offers.js"></script>
@endsection