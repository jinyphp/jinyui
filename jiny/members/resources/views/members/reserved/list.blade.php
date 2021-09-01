<div>
    

            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                        	<li class="breadcrumb-item active">Business</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">사이트 : 예약 이메일</h1>
                            <p>
                               
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

    <div class="relative">
        <div class="absolute bottom-4 right-0">
            
            <div class="btn-group">
                <a href="#" class="btn btn-secondary">메뉴얼</a>
                <x-link href="{{route($rules['routename'].'.create')}}" class="btn btn-primary">추가</x-link>
            </div>
        </div>
    </div>

    @include("jinymem::members.partials.filter")

    @include("jinymem::members.partials.datatable",['rules'=>$rules,'rows'=>$rows])
    @include("jinymem::members.partials.selected-delete")

</div>