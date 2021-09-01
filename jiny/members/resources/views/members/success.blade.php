<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
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
                        	<h1 class="h3 d-inline align-middle">사이트 : 회원목록</h1>
                            <p>
                            사이트의 회원을 관리합니다.
                            </p>
                    	</div>
                	</div>
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
                        <x-link href="{{route('members.create')}}" class="btn btn-primary">추가</x-link>
                    </div>
                </div>
            </div>

			@foreach ($posts as $key => $item)
				{{$key}} = {{$item}} <br>
			@endforeach

			{{ dd($posts) }}


		</x-container>
	</x-main-content>
</x-theme>