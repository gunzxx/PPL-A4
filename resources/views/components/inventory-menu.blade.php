<div class="menu">
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" ? "active" : '' }}">
        <a href="/inventory/">Persediaan</a>
    </div>
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "create" || array_reverse(explode('/',Request::url()))[1] == "create" ? "active" : '' }}">
        <a href="/inventory/create">Tambah Persediaan</a>
    </div>
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "update" || array_reverse(explode('/',Request::url()))[1] == "update" ? "active" : '' }}">
        <a href="/inventory/update">Perbarui Persediaan</a>
    </div>
</div>