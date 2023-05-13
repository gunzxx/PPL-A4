@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuInventory></x-menuInventory>

        @if (count($inventories)>0)
        <div class="card-container">
            @foreach ($inventories as $inventory)
            <div class="card">
                <div class="card-img">
                    <img src="{{ $inventory->getFirstMediaUrl("inv_img") != "" ? $inventory->getFirstMediaUrl("inv_img") : "/img/inventory/1.png" }}" height="240px" class="">
                </div>
                <div class="card-body">
                    <h1 style="text-align: center;"><span style="color:#41B167;">Jenis kedelai : </span>{{ $inventory->bean_type }}</h1>
                    <p style="text-align: center;"><span style="color:#41B167;"></span>Tersedia : {{ $inventory->stok }} kg kedelai</p>
                    <div class="action-container">
                        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/update/{{ $inventory->id }}" class="btn-inv edit-inv pointer">Update<i class="bi bi-pencil"></i></a>
                        <p data-inv-id="{{ $inventory->id }}" class="btn-inv delete-inv pointer">Hapus<i class="bi bi-trash-fill"></i></p>
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

    @error("message")
        <x-alertError :message="$message"></x-alertError>
    @enderror
    
    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif
@endsection

@section('script')
    <script src="/js/inventory/pengelola/manage.js"></script>
@endsection