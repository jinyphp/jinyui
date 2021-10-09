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
    


    {{-- 내용 --}}
    <div class="bd-content ps-lg-4">
        <x-markdown>{{$slot}}</x-markdown>
    </div>

</x-theme>  