@extends('template.main')

@section('content')
    <x-nav-all></x-nav-all>

    <main>
        <x-menuShopPengelola :active="$active"></x-menuShopPengelola>

        <div class="box-container">
            @if ($transactions->count()<1)
                <div>
                    <p align="center">Tidak ada data.</p>
                </div>
            @else
                @foreach ($transactions as $transaction)
                    <div class="list-card">
                        <div class="list-card-img" style="background-image: url('{{ $transaction->item->getFirstMediaUrl('product') != '' ? $transaction->item->getFirstMediaUrl('product') : '/img/shop/default.png' }}');">
                        </div>
                        <div class="list-card-nonimg">
                            <div class="list-card-body">
                                <div class="list-card-detail-container">
                                    <div class="list-card-detail">
                                        <p>Jenis Kedelai : {{ ucwords($transaction->bean_type) }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Jumlah : <span class="stok">{{ ucwords($transaction->amount) }}</span> kg</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Harga : Rp. {{ number_format($transaction->price,0,',','.') }},-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Total harga : Rp. {{ number_format($transaction->total_cost,0,',','.') }},-</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Alamat : {{ $transaction->pengelola->address }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Dikirim : {{ $transaction->delivery ? date('d M Y H:i:s',strtotime($transaction->delivery->send_at)) : "-" }}</p>
                                    </div>
                                    <div class="list-card-detail">
                                        <p>Diterima : {{ $transaction->delivery ? date('d M Y H:i:s',strtotime($transaction->delivery->accept_at)) : "-" }}</p>
                                    </div>
                                </div>
                                <div class="list-card-time">
                                    <p>{{ date('d M Y',strtotime($transaction->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </main>

    @if(session()->has('success'))
        <x-alertSuccess :message="session()->get('success')"></x-alertSuccess>
    @endif

    @if(session()->has('error'))
        <x-alertError :message="session()->get('error')"></x-alertError>
    @endif
@endsection