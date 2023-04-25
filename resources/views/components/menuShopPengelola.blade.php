<div class="menu">
    <div class="menu-item {{ explode('/',Request::url())[5] == "shop" ? "active" : '' }}">
        <a href="/pengelola/shop/shop">Tambah pembelian</a>
    </div>
    <div class="menu-item {{ explode('/',Request::url())[5] == "agreements" ? "active" : '' }}">
        <a href="/pengelola/shop/sale">Pembelian</a>
    </div>
</div>