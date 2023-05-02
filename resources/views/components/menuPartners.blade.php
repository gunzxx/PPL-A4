<div class="menu">
    @if (auth()->user()->hasRole('pengelola'))
        <div class="menu-item {{ explode('/',Request::url())[5] == "partners" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/partners/partners">Kerja Sama</a>
        </div>
    @endif
    <div class="menu-item {{ explode('/',Request::url())[5] == "offers" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/partners/offers">Penawaran</a>
    </div>
    <div class="menu-item {{ explode('/',Request::url())[5] == "agreements" ? "active" : '' }}">
        <a href="/{{ auth()->user()->getRoleNames()[0] }}/partners/agreements">Persetujuan</a>
    </div>
</div>