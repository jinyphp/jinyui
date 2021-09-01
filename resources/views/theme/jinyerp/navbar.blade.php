<style>
.navbar-right {
    margin-left: auto
}
</style>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    {{-- 토글버튼 --}}
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    {{-- 검색 --}}
    <form class="d-none d-sm-inline-block">
        <div class="input-group input-group-navbar">
            <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
            <button class="btn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </div>
    </form>

    {{-- 메가메뉴 --}}
    <ul class="navbar-nav d-none d-lg-block">
        <li class="nav-item px-2">
            @include("theme.adminkit.nav.megamenu")          
        </li>
    </ul>


    {{-- 우측 메뉴--}}
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                @include("theme.adminkit.nav.alram")
            </li>
            <li class="nav-item">
                @include("theme.adminkit.nav.message")
                
            </li>
            <li class="nav-item ">
                @include("theme.adminkit.nav.flag")
                
            </li>

            <li class="nav-item ">
                @include("theme.adminkit.nav.profile")
                
            </li>
        </ul>
    </div>
</nav>