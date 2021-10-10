{{-- 타이틀 로고 --}}
<a class="sidebar-brand" href="index.html">
    <span class="sidebar-brand-text align-middle">
        JinyUIKit
    </span>
</a>


{{-- @theme(".menu_tree") --}}
<!-- 사이드바 메뉴 -->
<x-menu json="menu/default.json">
    {{-- json 설정을 통하여 메뉴트리 생성 --}}
</x-menu>


{{-- Menu Footer --}}
<div class="sidebar-cta">
    <div class="sidebar-cta-content">
        <strong class="d-inline-block mb-2">Ducuments</strong>
        <div class="mb-3 text-sm">
            jinyuiKit is Component Builder!
        </div>

        <div class="d-grid">
            <a href="/docs" class="btn btn-outline-primary"
                target="_blank">Move</a>
        </div>
    </div>
</div>
