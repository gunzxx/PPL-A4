<div class="menu">
    <div class="menu-item {{ $active == "shop" ? "active" : '' }}">
        <a href="/petani/shop/shop">Pembelian</a>
    </div>
    <div class="menu-item {{ $active == "cart" ? "active" : '' }}">
        <a href="/petani/shop/cart">Keranjang</a>
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