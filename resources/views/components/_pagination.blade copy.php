<div>
@if ($paginator->hasPages())
    {{-- 이전페이지--}}
    @if ($paginator->onFirstPage())
        <button>
            <span class="arrow-left"></span>
        </button>
    @else
        <button wire:click="firstPage">
            <span class="-m-px px-2 py-1 
            border border-gray-400 bg-white text-gray-500
            hover:bg-blue-100">First</span>
        </button>

        <button wire:click="previousPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500 
                hover:bg-blue-100">Prev</span>
        </button>
    @endif

    {{-- 페이지 번호--}}
    @if (is_array($elements))
        @foreach ($elements as $element)
            @if (is_string($element))
                <button>
                    <span class="px-2 py-1 border 
                        border-gray-400 bg-white text-gray-500 
                        hover:bg-blue-100">
                        {{$element}}
                    </span>   
                </button>
            @endif

            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button>
                        <span class="-m-px px-2 py-1 
                            border border-gray-400 bg-gray-400 text-white">
                            {{$page}}
                        </span>
                    </button>
                @else
                    <button class="cursor-pointer" wire:click="gotoPage({{$page}})">
                        <span class="-m-px px-2 py-1 
                            border border-gray-400 bg-white text-gray-500
                            hover:bg-blue-100">
                            {{$page}}
                        </span>                        
                    </button>
                @endif
            @endforeach
        @endforeach
    @endif


    {{-- 다음페이지--}}
    @if ($paginator->hasMorePages())
        <a class="cursor-pointer" wire:click="nextPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Next</span>
        </a>

        <a class="cursor-pointer" wire:click="lastPage">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Last</span>
        </a>
    @else
        <a class="cursor-pointer">
            <span class="-m-px px-2 py-1 
                border border-gray-400 bg-white text-gray-500
                hover:bg-blue-100">Last</span>
        </a>
    @endif
@endif
</div>


