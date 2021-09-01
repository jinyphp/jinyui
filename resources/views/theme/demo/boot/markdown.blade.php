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

/*main-content*/
.layout-content {
    grid-area: content;
    min-width: 1px
}

</style>
<x-theme theme="demo.boot">
    <div class="container-xxl my-md-4  flex-grow">
        <x-layout class="layout">
            <x-layout-item aside class="layout-sidebar">
                <aside >
                    좌측 메뉴
                </aside>
            </x-layout-item>

            <x-layout class="layout-main order-1">
                <x-layout-item class="layout-intro">
                    <!-- 타이틀 -->
                </x-layout-item>   
    
                <x-layout-item class="layout-toc">
                    우측메뉴                  
                </x-layout-item>

                <x-layout-item class="layout-content">
                    {!! $content !!}
                </x-layout-item>
            </x-layout>
        </x-layout>
    </div>
</x-theme-app>