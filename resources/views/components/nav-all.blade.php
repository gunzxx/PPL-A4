<nav>
    <div class="title-nav">
        <a href="/" class="title-nav-text">SoySync</a>
    </div>
    <div class="nav-list">
        <div class="nav-item">
            <a class="{{ array_reverse(explode('/',Request::url()))[0] == "home" || array_reverse(explode('/',Request::url()))[1] == "home" || array_reverse(explode('/',Request::url()))[2] == "home" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/home">Beranda</a>
        </div>
        <div class="nav-item">
            <a class="{{ array_reverse(explode('/',Request::url()))[1] == "partners" || array_reverse(explode('/',Request::url()))[2] == "partners" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/partners">Kerja sama</a>
        </div>
        <div class="nav-item">
            <a class="{{ array_reverse(explode('/',Request::url()))[0] == "shop" || array_reverse(explode('/',Request::url()))[1] == "shop" || array_reverse(explode('/',Request::url()))[2] == "shop" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/shop">Jual Beli</a>
        </div>
        <div class="nav-item">
            <a class="{{ array_reverse(explode('/',Request::url()))[0] == "inventory" || array_reverse(explode('/',Request::url()))[1] == "inventory" || array_reverse(explode('/',Request::url()))[2] == "inventory" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/inventory">Inventori</a>
        </div>
    </div>

    <div class="profile-nav">
        <div class="name-profile-nav">
            <h1>{{ auth()->user()->fullname }}</h1>
            <p>{{ auth()->user()->getRoleNames()[0] == "pengelola" ? ucfirst(auth()->user()->getRoleNames()[0])." susu" : ucfirst(auth()->user()->getRoleNames()[0]) }} kedelai</p>
        </div>
        <div class="profile-image-container bg-transparent-img">
            <img class="profile-img" src="{{ auth()->user()->getFirstMediaUrl("profile") != "" ? auth()->user()->getFirstMediaUrl("profile") : "/img/profile/default.png" }}" alt="">
        </div>
    </div>
</nav>

<div class="profile-menu-container">
    <div class="backdrop-profile"></div>
    <div class="card-profile-menu">
        <a href="/profile" class="profile-menu-list">Profil</a>
        <a href="/profile/password" class="profile-menu-list">Ganti password</a>
        <a href="/premium" class="profile-menu-list">Premium</a>
        <div class="profile-menu-decide">
            <hr>
        </div>
        <a class="profile-menu-list logout">Logout&nbsp;<i class="bi bi-box-arrow-right"></i></a>
    </div>
</div>