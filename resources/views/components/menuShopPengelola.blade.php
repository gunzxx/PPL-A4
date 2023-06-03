<div class="menu">
    <div class="menu-item {{ $active == "shop" ? "active" : '' }}">
        <a href="/pengelola/shop/shop">Tambah Pembelian</a>
    </div>
    <div class="menu-item {{ $active == "cart" ? "active" : '' }}">
        <a href="/pengelola/shop/cart">Keranjang</a>
    </div>
    <div class="menu-item {{ $active == "payment" ? "active" : '' }}">
        <a href="/pengelola/shop/payment">Pembayaran</a>
    </div>
    <div class="menu-item {{ $active == "delivery" ? "active" : '' }}">
        <a href="/pengelola/shop/delivery">Pengiriman</a>
    </div>
    <div class="menu-item {{ $active == "history" ? "active" : '' }}">
        <a href="/pengelola/shop/history">Riwayat</a>
    </div>
</div>