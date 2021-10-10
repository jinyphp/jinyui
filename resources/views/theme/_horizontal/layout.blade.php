<style>
.content-page {
    margin-left: 260px;
    overflow: hidden;
    padding: 70px 12px 65px;
    min-height: 100vh
}

body[data-layout=topnav] .content-page {
    margin-left: 0 !important;
    padding: 0 0 60px 0
}

@media (min-width:1200px) {
    body[data-leftbar-compact-mode=scrollable]:not([data-layout=topnav]) {
        padding-bottom: 0
    }

    body[data-leftbar-compact-mode=scrollable]:not([data-layout=topnav]) .wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex
    }

    body[data-leftbar-compact-mode=scrollable]:not([data-layout=topnav]) .leftside-menu {
        position: relative;
        min-width: 260px;
        max-width: 260px;
        padding-top: 0
    }

    body[data-leftbar-compact-mode=scrollable]:not([data-layout=topnav]) .logo {
        position: relative;
        margin-top: 0
    }

    body[data-leftbar-compact-mode=scrollable]:not([data-layout=topnav]) .content-page {
        margin-left: 0;
        width: 100%;
        padding-bottom: 60px
    }
}
</style>
<div class="content-page">
    <div class="content">
        @include("theme.horizontal.header")
        @include("theme.horizontal.topnav")
    </div>
</div>



