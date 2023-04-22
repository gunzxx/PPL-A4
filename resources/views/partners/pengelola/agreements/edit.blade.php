@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="card-container">
            <form class="form-container" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/agreements/edit">
                @csrf
                <input type="hidden" name="agreement_detail_id" value="{{ $agreement_detail->id }}">
                <input type="hidden" name="agreement_id" value="{{ $agreement_detail->agreement->id }}">
                <div class="form-group">
                    <input value="{{ old('bean_type') ? old('bean_type') : $agreement_detail->agreement->bean_type  }}" class="form-input" required name="bean_type" placeholder="Masukkan jenis kedelai" id="bean_type" cols="30" rows="10">
                    @error('bean_type')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('stok') ? old('stok') : $agreement_detail->agreement->stok  }}" class="form-input numeric" required name="stok" placeholder="Masukkan stok kedelai" id="stok" cols="30" rows="10">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('price') ? old('price') : $agreement_detail->agreement->price  }}" class="form-input numeric" required name="price" placeholder="Masukkan harga kedelai" id="price" cols="30" rows="10">
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="old_offer_detail_id" value="{{ $agreement_detail->offerDetail->id }}">
                <div class="form-group">
                    @if ($offer_details->count()>0)
                        <select class="form-input @error('bean_id') invalid @enderror" required name="offer_detail_id" id="bean_id">
                            @foreach ($offer_details as $offer_detail)
                                <option @if($offer_detail->id == $agreement_detail->offerDetail->id) selected @endif value="{{ $offer_detail->id }}">{{ ucfirst($offer_detail->petani->fullname) }} - {{ ucfirst($offer_detail->offer->name) }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="kosong">Tidak ada penawaran, harap <a href="/petani/inventory/create" class="error">Tambah penawaran</a></p>
                    @endif
                </div>
                <div class="form-group row">
                    <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                    <button class="save-btn" type="submit">Save</button>
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
