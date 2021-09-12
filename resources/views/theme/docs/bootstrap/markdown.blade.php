<x-theme theme="docs.bootstrap">

    {{-- 페이지 타이틀 --}}
    @if (isset($title))
        <div class="bd-intro ps-lg-4">
            <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
                <a class="btn btn-sm btn-bd-light mb-2 mb-md-0"
                    href="https://github.com/jinyphp/jinyui"
                    title="View and edit this file on GitHub" target="_blank" rel="noopener">View on GitHub</a>

                <h1 class="bd-title" id="content">{{$title}}</h1>
            </div>

            @if (isset($subtitle))
                <p class="bd-lead">{{$subtitle}}</p>
            @endif            
        </div>
    @endif
    

    {{-- 오른쪽 서브메뉴 --}}
    {{--
    <div class="bd-toc mt-4 mb-5 my-md-0 ps-xl-3 mb-lg-5 text-muted">
        <strong class="d-block h6 my-2 pb-2 border-bottom">On this page</strong>
        <nav id="TableOfContents">
            <ul>
                <li><a href="#quick-start">Quick start</a>
                    <ul>
                        <li><a href="#css">CSS</a></li>
                        <li><a href="#js">JS</a>
                            <ul>
                                <li><a href="#bundle">Bundle</a></li>
                                <li><a href="#separate">Separate</a></li>
                                <li><a href="#modules">Modules</a></li>
                                <li><a href="#components">Components</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#starter-template">Starter template</a></li>
                <li><a href="#important-globals">Important globals</a>
                    <ul>
                        <li><a href="#html5-doctype">HTML5 doctype</a></li>
                        <li><a href="#responsive-meta-tag">Responsive meta tag</a></li>
                        <li><a href="#box-sizing">Box-sizing</a></li>
                        <li><a href="#reboot">Reboot</a></li>
                    </ul>
                </li>
                <li><a href="#community">Community</a></li>
            </ul>
        </nav>
    </div>
    --}}

    {{-- 내용 --}}
    <div class="bd-content ps-lg-4">
        {!! $content !!}
    </div>

    
</x-theme>  