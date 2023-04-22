<div class="menu">
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory">Inventori</a>
    </div>
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "create" || array_reverse(explode('/',Request::url()))[1] == "create" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/create">Tambah Inventori</a>
    </div>
    <div class="menu-item {{ array_reverse(explode('/',Request::url()))[0] == "update" || array_reverse(explode('/',Request::url()))[1] == "update" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory/update">Kelola Inventori</a>
    </div>
</div>