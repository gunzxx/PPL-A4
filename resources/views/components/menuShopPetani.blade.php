<div class="menu">
    <div class="menu-item {{ $active == "shop" ? "active" : '' }}">
        <a href="/petani/shop/shop">Penjualan</a>
    </div>
    <div class="menu-item {{ $active == "payment" ? "active" : '' }}">
        <a href="/petani/shop/sale">Pembayaran</a>
    </div>
    <div class="menu-item {{ $active == "delivery" ? "active" : '' }}">
        <a href="/petani/shop/sale">Pengiriman</a>
    </div>
    <div class="menu-item {{ $active == "history" ? "active" : '' }}">
        <a href="/petani/shop/sale">Riwayat</a>
    </div>
</div>