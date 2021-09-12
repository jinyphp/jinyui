{{-- css load --}}
@theme(".boot")

{{-- grid layouts--}}
<style>
@media (min-width: 768px) {
    .layout {
        display: grid; /*그리드 설정*/
        gap: 1.5rem;
        grid-template-areas: "sidebar main";
        grid-template-columns: 1fr 3fr
    }
}

@media (min-width: 992px) {
    .layout {
        grid-template-columns: 1fr 5fr
    }
}

/*사이드*/
.layout-sidebar {
    grid-area: sidebar
}
@media (max-width: 767.98px) {
    .layout-sidebar {
        margin: 0 -.75rem 1rem
    }
}

.layout-sidebar-toggle {
    color: #6c757d
}

.layout-sidebar-toggle:hover,
.layout-sidebar-toggle:focus {
    color: #7952b3
}

.layout-sidebar-toggle:focus {
    box-shadow: 0 0 0 3px rgba(121, 82, 179, 0.25)
}

.layout-sidebar-toggle .bi-collapse {
    display: none
}

.layout-sidebar-toggle:not(.collapsed) .bi-expand {
    display: none
}

.layout-sidebar-toggle:not(.collapsed) .bi-collapse {
    display: inline-block
}

/* main */
.layout-main {
    grid-area: main
}

@media (min-width: 768px) {
    .layout-main {
        display: grid; /*그리드 설정*/
        gap: inherit;
        grid-template-areas: "intro""toc""content";
        grid-template-rows: auto auto 1fr
    }
}

@media (min-width: 992px) {
    .layout-main {
        grid-template-areas: "intro   toc""content toc";
        grid-template-columns: 4fr 1fr;
        grid-template-rows: auto 1fr
    }
}

/*main-intro*/
.layout-intro {
    grid-area: intro
}

/*main-toc*/
.layout-toc {
    grid-area: toc
}
@media (min-width: 992px) {
    .layout-toc {
        position: -webkit-sticky;
        position: sticky;
        top: 5rem;
        right: 0;
        z-index: 2;
        height: calc(100vh - 7rem);
        overflow-y: auto
    }
}

.layout-toc nav {
    font-size: .875rem
}

.layout-toc nav ul {
    padding-left: 0;
    list-style: none
}

.layout-toc nav ul ul {
    padding-left: 1rem;
    margin-top: .25rem
}

.layout-toc nav li {
    margin-bottom: .25rem
}

.layout-toc nav a {
    color: inherit
}

.layout-toc nav a:not(:hover) {
    text-decoration: none
}

.layout-toc nav a code {
    font: inherit
}

/*main-content*/
.layout-content {
    grid-area: content;
    min-width: 1px
}

.layout-content .highlight {
    margin-right: -.75rem;
    margin-left: -.75rem
}

@media (min-width: 576px) {
    .layout-content .highlight {
        margin-right: 0;
        margin-left: 0
    }
}


.layout-content>h2:not(:first-child) {
    margin-top: 3rem
}

.layout-content>h3 {
    margin-top: 2rem
}

.layout-content>ul li,
.layout-content>ol li {
    margin-bottom: .25rem
}

.layout-content>ul li>p~ul,
.layout-content>ol li>p~ul {
    margin-top: -.5rem;
    margin-bottom: 1rem
}

.layout-content>.table {
    max-width: 100%;
    margin-bottom: 1.5rem;
    font-size: .875rem
}

@media (max-width: 991.98px) {
    .layout-content>.table {
        display: block;
        overflow-x: auto
    }

    .layout-content>.table.table-bordered {
        border: 0
    }
}

.layout-content>.table th:first-child,
.layout-content>.table td:first-child {
    padding-left: 0
}

.layout-content>.table th:not(:last-child),
.layout-content>.table td:not(:last-child) {
    padding-right: 1.5rem
}

.layout-content>.table td:first-child>code {
    white-space: nowrap
}

</style>


<x-theme-app>
    <div class="container-xxl my-md-4">
        <x-layout class="layout">
            <x-layout-item aside class="layout-sidebar">
                <aside >
                    좌측 메뉴
                </aside>
            </x-layout-item>

            <x-layout class="layout-main order-1">
                <x-layout-item class="layout-intro">
                    <div class="d-md-flex align-items-center justify-content-between">
                        <h1 class="layout-title" id="content">Introduction</h1>
                    </div>
                    <p class="layout-lead">Get started with Bootstrap, the world’s most popular framework for building
                        responsive, mobile-first sites, with jsDelivr and a template starter page.</p>
                </x-layout-item>   
    
                <x-layout-item class="layout-toc">
                    @theme(".submenu")                    
                </x-layout-item>

                <x-layout-item class="layout-content">
                    <!-- -->
                    <h2 id="quick-start">Quick start
                        <a class="anchorjs-link " aria-label="Anchor" data-anchorjs-icon="#"
                            href="#quick-start" style="padding-left: 0.375em;"></a>
                    </h2>
                    <p>Looking to quickly add Bootstrap to your project? Use jsDelivr, a free open source CDN. Using a
                        package manager or need to download the source files? 
                    </p>
    
    
                    <!-- -->
                    <h2 id="important-globals">Important globals
                        <a class="anchorjs-link " aria-label="Anchor"
                            data-anchorjs-icon="#" href="#important-globals" style="padding-left: 0.375em;"></a>
                    </h2>
                    <p>Bootstrap employs a handful of important global styles and settings that you’ll need to be aware of
                        when using it, all of which are almost exclusively geared towards the <em>normalization</em> of
                        cross browser styles. Let’s dive in.</p>
                </x-layout-item>
            </x-layout>
        </x-layout>
    </div>
</x-theme-app>