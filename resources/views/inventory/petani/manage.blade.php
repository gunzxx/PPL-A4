@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuInventory></x-menuInventory>

        @if (count($inventories)>0)
        <div class="title-page">
            <h1>Pilih persediaan yang ingin anda perbarui</h1>
        </div>
        <div class="card-container">
            @foreach ($inventories as $inventory)
            <div class="card">
                <img src="/img/inventory/1.png" height="240px" class="card-img">
                <div class="card-body">
                    <p style="text-align: center;">Jenis kedelai : {{ $inventory->bean_type }}</p>
                    <p style="text-align: center;">Tersedia : {{ $inventory->stok }} kg kedelai</p>
                    <div class="action-container">
                        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/update/{{ $inventory->id }}" class="btn-danger edit-inv pointer"><i class="bi bi-pencil"></i></a>
                        <span data-inv-id="{{ $inventory->id }}" class="btn-danger delete-inv pointer"><i class="bi bi-trash"></i></span>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $inventories->links() }}
        </div>
        @else
            <h1 style="text-align: center;padding:50px 0;">Persediaan masih kosong. <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/create">Tambah sekarang!</a></h1>
        @endif
    </main>

    <div class="popup-backdrop delete-inventory">
        <div class="popup-container">
            <div class="popup-text">Apakah yakin melakukan penghapusan data?</div>
            <div class="popup-alert">
                <button onclick="deleteInventory()" value="true" class="popup-confirm popup-yes" type="button">Yes</button>
                <button value="false" class="popup-confirm popup-no" type="button">No</button>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
        <input type="hidden" id="error-msg" value="{{ session()->get('success') }}">
        <script>
            alert($("#error-msg").val())
        </script>
    @endif
@endsection

@section('script')
    <script src="/js/inventory/petani/manage.js"></script>
@endsection