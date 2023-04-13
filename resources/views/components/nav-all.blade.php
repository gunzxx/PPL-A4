<nav>
    <div class="title-nav">
        <h1>SoySync</h1>
    </div>
    <div class="nav-list">
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "home" || array_reverse(explode('/',Request::url()))[1] == "home" || array_reverse(explode('/',Request::url()))[2] == "home" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/home">Beranda</a>
        </div>
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "partners" || array_reverse(explode('/',Request::url()))[1] == "partners" || array_reverse(explode('/',Request::url()))[2] == "partners" ? "active" : '' }}">
            <a href="/partners">Kerja sama</a>
        </div>
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "shop" || array_reverse(explode('/',Request::url()))[1] == "shop" || array_reverse(explode('/',Request::url()))[2] == "shop" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/shop">Jual Beli</a>
        </div>
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" || array_reverse(explode('/',Request::url()))[1] == "inventory" || array_reverse(explode('/',Request::url()))[2] == "inventory" ? "active" : '' }}">
            <a href="/inventory">Inventori</a>
        </div>
    </div>
    <div class="profile-nav">
        <div class="name-profile-nav">
            <h1>{{ auth()->user()->fullname }}</h1>
            <p>{{ ucfirst(auth()->user()->getRoleNames()[0]) }} kedelai</p>
        </div>
        <img src="/img/profile/1.png" alt="">
    </div>
</nav>