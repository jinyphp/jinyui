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
                        	<h1 class="h3 d-inline align-middle">계시물 보기</h1>
                            <p>
                                
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			{formstart}
			{board_title}

			{title}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:10px;padding:5px;" align="right">{regdate}&nbsp; {email}</td>
				</tr>
			</table>
			<p>{images}</p>

			{html}
			{files}

			{listback}
			{form_submit}

			{comment}
			{formend}



		</x-container>
	</x-main-content>
</x-theme>

