<div>
    <!-- start page title -->
	<x-row >
		<x-col class="col-8">
			@include("jinymem::members.partials.title",['rules'=>$rules])
		</x-col>
	</x-row>  
	<!-- end page title -->

    <!-- 추가 버튼 링크 -->
	@include("jinymem::members.partials.link-list")

    <x-row>
        <x-col>

            <x-card>
                <x-card-body>
                    <h5 class="card-title">사용자를 등록합니다.</h5>
                    <h6 class="card-subtitle text-muted"></h6>
                    
                    @foreach ($rules['fields'] as $item)
                        @if (isset($item['form']) && $item['form'])
                            @if($item['input'] == "html")
                            
                            @elseif ($item['input'] == "hidden")
                                {!! $forms->input($item) !!}
                            @else
                                <x-form-hor>
                                    <x-form-label>
                                        {{ $item['title'] }}
                                    </x-form-label>
                                    <x-form-item>
                                        {!! $forms->input($item) !!}
                                    </x-form-item>
                                </x-form-hor>
                            @endif                        
                        @endif
                    @endforeach

                    {{-- --}}
                    @include("jinymem::members.partials.submit")

                </x-card-body>
            </x-card>

        </x-col>
    </x-row>
</div>
