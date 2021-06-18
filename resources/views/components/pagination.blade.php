
@if ($paginator->hasPages())
    {{-- 이전페이지--}}
    @if ($paginator->onFirstPage())
        <a href="#">
            <span class="arrow-left"></span>
        </a>
    @else
        <a href="#" wire:click="firstPage">
            <span class="-m-px px-2 py-1 
            border border-gray-400 bg-white text-gray-500
            hover:bg-blue-100">First</span>
        </a>
        <a href="#" wire:click="previousPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500 
                hover:bg-blue-100">Prev</span>
        </a>
    @endif

    {{-- 페이지 번호--}}
    @if (is_array($elements))
        @foreach ($elements as $element)
            @if (is_string($element))
                <a href="#{{$page}}">
                    <span class="px-2 py-1 border 
                        border-gray-400 bg-white text-gray-500 
                        hover:bg-blue-100">
                        {{$element}}
                    </span>   
                </a>
            @endif

            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#{{$page}}" >
                        <span class="-m-px px-2 py-1 
                            border border-gray-400 bg-gray-400 text-white">
                            {{$page}}
                        </span>
                    </a>
                @else
                    <a href="#{{$page}}"  wire:click="gotoPage({{$page}})">
                        <span class="-m-px px-2 py-1 
                            border border-gray-400 bg-white text-gray-500
                            hover:bg-blue-100">
                            {{$page}}
                        </span>                        
                    </a>
                @endif
            @endforeach
        @endforeach
    @endif


    {{-- 다음페이지--}}
    @if ($paginator->hasMorePages())
        <a href="#" wire:click="nextPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Next</span>
        </a>

        <a href="#" wire:click="lastPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Last</span>
        </a>
    @else
        <a href="#">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Last</span>
        </a>
    @endif
@endif

