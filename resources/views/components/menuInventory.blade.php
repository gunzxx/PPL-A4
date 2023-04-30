<div class="menu">
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory">Inventori</a>
    </div>
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "create" || array_reverse(explode('/',Request::url()))[1] == "create" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/create">Tambah Persediaan</a>
    </div>
</div>