<div class="menu">
    <div class="menu-item {{ explode('/',Request::url())[5] == "shop" ? "active" : '' }}">
        <a href="/petani/shop/shop">Tambah penjualan</a>
    </div>
    <div class="menu-item {{ explode('/',Request::url())[5] == "agreements" ? "active" : '' }}">
        <a href="/petani/shop/sale">Penjualan</a>
    </div>
</div>