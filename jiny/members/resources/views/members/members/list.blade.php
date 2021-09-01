<div>
	<!-- start page title -->
	<x-row >
		<x-col class="col-8">
			@include("jinymem::members.partials.title",['rules'=>$rules])
		</x-col>
	</x-row>  
	<!-- end page title -->


	<div class="relative">
		<div class="absolute bottom-4 right-0">
			<div class="btn-group">
				<x-link href="#" class="btn btn-info">reserved</x-link>
				<x-link href="#" class="btn btn-info">blacklist</x-link>
				<x-link href="#" class="btn btn-info">poin</x-link>
				<x-link href="#" class="btn btn-info">emoney</x-link>
			</div>

			<div class="btn-group">
				<a href="#" class="btn btn-secondary">메뉴얼</a>
				<x-link href="{{route($rules['routename'].'.create')}}" class="btn btn-primary">추가</x-link>
			</div>
		</div>
	</div>


			
    <!-- 검색필터 -->
	@if (isset($rules['filter']))
	<x-row>
		<x-col-12>
			@include("jinymem::members.partials.filter")
		</x-col-12>				
	</x-row>
	@endif
    
	<!-- 테이블 목록 -->
	<x-row>
		<x-col-12>
			@include("jinymem::members.partials.datatable",['rules'=>$rules,'rows'=>$rows])
		</x-col-12>
	</x-row>

	<x-row>
		<x-col-6>
			@include("jinymem::members.partials.selected-delete")
		</x-col-6>            
	</x-row>

</div>


