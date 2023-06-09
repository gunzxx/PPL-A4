@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="card-container">
            <form id="agreement-required-form" class="form-container required-form" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/agreements/create">
                @csrf
                <div class="form-group">
                    <input value="{{ old('bean_type') ? old('bean_type') : $offer_details[0]->offer()->get("bean_id")->first()->inventory()->get("bean_type")->first()->bean_type }}" class="form-input" readonly name="bean_type" placeholder="Masukkan jenis kedelai" id="bean_type">
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
                        <select class="form-input @error('bean_id') invalid @enderror" name="offer_detail_id" id="offer_detail_id">
                            @foreach ($offer_details as $offer_detail)
                                @if(session()->has("offer_detail_id"))
                                <option value="{{ $offer_detail->id }}" @if(session()->get("offer_detail_id")==$offer_detail->id) selected @endif>{{ ucfirst($offer_detail->petani->fullname) }} - {{ date("d F Y (H:i:s)", strtotime($offer_detail->offer->created_at)) }}</option>
                                @else
                                <option value="{{ $offer_detail->id }}">{{ ucfirst($offer_detail->petani->fullname) }} - {{ date("d F Y (H:i:s)", strtotime($offer_detail->offer->created_at)) }}</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <p class="kosong">Tidak ada penawaran, harap <a href="/petani/inventory/create" class="error">tambah inventori</a></p>
                    @endif
                </div>
                <div class="form-group row">
                    <a class="btn-danger" href="/pengelola/partners/agreements">Batal</a>
                    <button class="save-btn" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </main>

    @error("message")
        <x-alertError :message="$message"></x-alertError>
    @enderror
    @if(session()->has('message'))
    @endif
@endsection

@section('script')
    <script src="/js/partner/pengelola/agreement_form.js"></script>
@endsection