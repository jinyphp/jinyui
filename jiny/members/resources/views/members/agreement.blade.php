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
                        	<h1 class="h3 d-inline align-middle">회원가입동의서</h1>
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

            {formstart}

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">{list_num}</td>
                    <td style="font-size:12px;padding:10px;">{search_key}</td>
                    <td style="font-size:12px;padding:10px;" width="80">{search}</td>
                    <td style="font-size:12px;padding:10px;" width="80"> </td>
                </tr>
            </table>
			
            {agreement_list}
            {formend}



		</x-container>
	</x-main-content>
</x-theme>