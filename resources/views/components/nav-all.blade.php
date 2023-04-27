<nav>
    <div class="title-nav">
        <a href="/" class="title-nav-text">SoySync</a>
    </div>
    <div class="nav-list">
        <div class="nav-item">
            <a class="{{ array_reverse(explode('/',Request::url()))[0] == "home" || array_reverse(explode('/',Request::url()))[1] == "home" || array_reverse(explode('/',Request::url()))[2] == "home" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/home">Beranda</a>
        </div>
        <div class="nav-item">
            <a class="{{ explode('/',Request::url())[4] == "partners" || array_reverse(explode('/',Request::url()))[1] == "partners" || array_reverse(explode('/',Request::url()))[2] == "partners" ? "active" : '' }}" href="/{{ auth()->user()->getRoleNames()[0] }}/partners">Kerja sama</a>
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
            <p>{{ ucfirst(auth()->user()->getRoleNames()[0]) }} kedelai</p>
        </div>
        <div class="profile-image-container">
            <img class="profile-img" src="{{ auth()->user()->getFirstMediaUrl("profile") != "" ? auth()->user()->getFirstMediaUrl("profile") : "/img/profile/default.jpg" }}" alt="">
        </div>
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