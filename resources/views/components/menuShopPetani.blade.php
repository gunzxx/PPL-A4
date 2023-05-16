<div class="menu">
    <div class="menu-item {{ $active == "shop" ? "active" : '' }}">
        <a href="/petani/shop/shop">Penjualan</a>
    </div>
    <div class="menu-item {{ $active == "payment" ? "active" : '' }}">
        <a href="/petani/shop/payment">Pembayaran</a>
    </div>
    <div class="menu-item {{ $active == "delivery" ? "active" : '' }}">
        <a href="/petani/shop/delivery">Pengiriman</a>
    </div>
    <div class="menu-item {{ $active == "history" ? "active" : '' }}">
        <a href="/petani/shop/history">Riwayat</a>
    </div>
</div>