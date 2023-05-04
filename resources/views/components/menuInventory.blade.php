<div class="menu">
    <div class="menu-item {{ explode('/',Request::url())[5] == "inventory" || explode('/',Request::url())[5] == "update" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory">Inventori</a>
    </div>
    <div class="menu-item {{ explode('/',Request::url())[5] == "create" || array_reverse(explode('/',Request::url()))[1] == "create" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/create">Tambah Persediaan</a>
    </div>
</div>