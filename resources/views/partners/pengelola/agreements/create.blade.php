@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="card-container">
            <form class="form-container required-form" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/agreements/create">
                @csrf
                <div class="form-group">
                    <input value="{{ old('bean_type') }}" class="form-input" name="bean_type" placeholder="Masukkan jenis kedelai" id="bean_type" cols="30" rows="10">
                    @error('bean_type')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('stok') }}" class="form-input numeric" name="stok" placeholder="Masukkan stok kedelai" id="stok" cols="30" rows="10">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('price') }}" class="form-input numeric" name="price" placeholder="Masukkan harga kedelai" id="price" cols="30" rows="10">
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    @if ($offer_details->count()>0)
                        <select class="form-input @error('bean_id') invalid @enderror" name="offer_detail_id" id="bean_id">
                            @foreach ($offer_details as $offer_detail)
                                <option value="{{ $offer_detail->id }}">{{ ucfirst($offer_detail->petani->fullname) }} - {{ date("d F Y (H:i:s)", strtotime($offer_detail->offer->created_at)) }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="kosong">Tidak ada penawaran, harap <a href="/petani/inventory/create" class="error">tambah inventori</a></p>
                    @endif
                </div>
                <div class="form-group row">
                    <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                    <button class="save-btn" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </main>

    @error("message")
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror
@endsection
