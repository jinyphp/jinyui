@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">
@endpush
@push('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
@endpush

<x-theme theme="adminkit">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">
                        @if (isset($breadcrumb))
                            <ol class="breadcrumb m-0">
                                {{--
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Theme</a></li>
                                <li class="breadcrumb-item active">Grid</li>
                                --}}
                                @foreach ($breadcrumb as $item)
                                    <li class="breadcrumb-item active">{{$item}}</li>
                                @endforeach
                            </ol>
                        @endif

        				<div class="mb-3">
                            @if (isset($title))
                            <h1 class="h3 d-inline align-middle">{{$title}}</h1>
                            @endif
                            @if (isset($subtitle))
                                <p>{{$subtitle}}</p>
                            @endif                            
                    	</div>

                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

            @if (isset($demo))
            <div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="{{$demo}}" class="btn btn-success">Demo</a>
                    </div>
                </div>
            </div>
            @endif
            

            <x-row>
                <x-col-12>
                    <x-card>
                        <x-card-body class="markdown">
                            {!! $content !!}
                        </x-card-body>
                    </x-card>
                </x-col-12>
            </x-row>         

        </x-container>
    </x-main-content>
</x-theme>

