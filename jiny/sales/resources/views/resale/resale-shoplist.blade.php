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
                        	<h1 class="h3 d-inline align-middle">업체검색</h1>
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
                        <a href="#" class="btn btn-primary">추가</a>
                    </div>
                </div>
            </div>

			<table border="0" width="800" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-top:1px solid #E9E9E9;border-left:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" width="100">
							</td>
					<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
					{searchkey}</td>		
					<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" width="50">
					{btn_search}</td>		
					<td style="border-top:1px solid #E9E9E9;border-left:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" width="50">
					{close}</td>
				</tr>
			</table>

			{list}

		</x-container>
	</x-main-content>
</x-theme>

