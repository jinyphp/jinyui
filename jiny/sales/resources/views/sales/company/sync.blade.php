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
                        	<li class="breadcrumb-item active">Company</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">판매관리:거래처 연결 체크</h1>
                            <p>자사의 이메일 기준으로 거래를 하고 있는 
								모든 거래처를 연결 동기화 합니다. 새로운 거래처를 쉽게 등록할 수 있으며, 상대방의 정보 변경시 업데이트를 통하여 
								손쉽게 거래처 정보를 갱신할 수 있습니다.</p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->


			{formstart}
				{datalist}
			{formend}

		</x-container>
	</x-main-content>
</x-theme>

