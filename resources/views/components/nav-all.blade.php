<nav>
    <div class="title-nav">
        <a href="/home">SoySync</a>
    </div>
    <div class="nav-list">
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "home" || array_reverse(explode('/',Request::url()))[1] == "home" || array_reverse(explode('/',Request::url()))[2] == "home" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/home">Beranda</a>
        </div>
        <div class="nav-item {{ explode('/',Request::url())[4] == "partners" || array_reverse(explode('/',Request::url()))[1] == "partners" || array_reverse(explode('/',Request::url()))[2] == "partners" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/partners">Kerja sama</a>
        </div>
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "shop" || array_reverse(explode('/',Request::url()))[1] == "shop" || array_reverse(explode('/',Request::url()))[2] == "shop" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/shop">Jual Beli</a>
        </div>
        <div class="nav-item {{ array_reverse(explode('/',Request::url()))[0] == "inventory" || array_reverse(explode('/',Request::url()))[1] == "inventory" || array_reverse(explode('/',Request::url()))[2] == "inventory" ? "active" : '' }}">
            <a href="/{{ auth()->user()->getRoleNames()[0] }}/inventory">Inventori</a>
        </div>
    </div>

    <div class="profile-nav">
        <div class="name-profile-nav">
            <h1>{{ auth()->user()->fullname }}</h1>
            <p>{{ ucfirst(auth()->user()->getRoleNames()[0]) }} kedelai</p>
        </div>
        <img class="profile-img" src="/img/profile/{{ auth()->user()->hasRole('pengelola')? 1 : 2 }}.png" alt="">
    </div>
</nav>

<div class="profile-menu-container">
    <div class="backdrop-profile"></div>
    <div class="card-profile-menu">
        <div class="profile-menu-list">
            <a>Edit Profil</a>
        </div>
        <div class="profile-menu-list">
            <a>Menu 2</a>
        </div>
        <div class="profile-menu-list">
            <a>Menu 3</a>
        </div>
        <hr>
        <div class="profile-menu-list">
            <a class="logout">Logout&nbsp;<i class="bi bi-box-arrow-right"></i></a>
        </div>
    </div>
</div>