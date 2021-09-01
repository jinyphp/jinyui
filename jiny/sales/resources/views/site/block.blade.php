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
                        	<h1 class="h3 d-inline align-middle">사이트: 디자인블럭</h1>
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

			<!-- 검색필터 -->
			<x-row>
				<x-col-12>					
					<x-card>
						<x-card-body>
							<x-row>
								<table border="0" width="978" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="font-size:12px;padding:10px;" width="80">검색:</td>
                                        <td style="font-size:12px;padding:10px;">{search_key}</td>
                                        <td style="font-size:12px;padding:10px;" width="80">{search}</td>
                                        <td style="font-size:12px;padding:10px;" width="80">{new}</td>
                                    </tr>
                                </table>
							</x-row>					
						</x-card-body>						
					</x-card>					
				</x-col-12>				
			</x-row>

			<!-- 데이터 테이블 -->
			<x-row>
				<x-col-12>
					<x-card>
						<x-card-body>
							<x-table condensed>
								<x-table-head>
									<th style="width:40%;">Name</th>
                            		<th style="width:25%">Phone Number</th>
                            		<th style="width:25%">Date of Birth</th>
                            		<th>Actions</th>
								</x-table-head>
								<x-table-body></x-table-body>
							</x-table>
						</x-card-body>
					</x-card>
				</x-col-12>
			</x-row>

		</x-container>
	</x-main-content>
</x-theme>