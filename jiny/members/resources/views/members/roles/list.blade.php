<div>
	<!-- start page title -->
	<x-row >
		<x-col class="col-8">
			@include("jinymem::members.partials.title",['rules'=>$rules])
		</x-col>
	</x-row>  
	<!-- end page title -->

	<!-- 추가 버튼 링크 -->
	@include("jinymem::members.partials.link-create")

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


