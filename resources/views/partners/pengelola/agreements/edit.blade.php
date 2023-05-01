@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuPartners></x-menuPartners>

        <div class="card-container">
            <form class="form-container form-update" method="POST" action="/{{ auth()->user()->getRoleNames()[0] }}/partners/agreements/edit">
                @csrf
                <input type="hidden" name="agreement_detail_id" value="{{ $agreement_detail->id }}">
                <input type="hidden" name="agreement_id" value="{{ $agreement_detail->agreement->id }}">
                <div class="form-group">
                    <input value="{{ old('bean_type') ? old('bean_type') : $agreement_detail->agreement->bean_type  }}" class="form-input" name="bean_type" placeholder="Masukkan jenis kedelai" id="bean_type" cols="30" rows="10">
                    @error('bean_type')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('stok') ? old('stok') : $agreement_detail->agreement->stok  }}" class="form-input numeric" name="stok" placeholder="Masukkan stok kedelai" id="stok" cols="30" rows="10">
                    @error('stok')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input value="{{ old('price') ? old('price') : $agreement_detail->agreement->price  }}" class="form-input numeric" name="price" placeholder="Masukkan harga kedelai" id="price" cols="30" rows="10">
                    @error('price')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="offer_detail_id" value="{{ $agreement_detail->offerDetail->id }}">
                <div class="form-group row">
                    <button class="btn-danger cancel-action" type="button" href="/inventory">Batal</button>
                    <button class="save-btn" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </main>

    <div class="popup-backdrop cek-update">
        <div class="popup-container">
            <div class="popup-text">Apakah data sudah sesuai?</div>
            <div class="popup-alert">
                <button value="true" class="popup-confirm popup-yes popup-yes-update" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no popup-no-update" type="button">No</button>
            </div>
        </div>
    </div>

    @error("duplicate")
        <input type="hidden" id="error-msg" value="{{ $message }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @enderror
@endsection
