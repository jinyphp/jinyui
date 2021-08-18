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
                        	<h1 class="h3 d-inline align-middle">이머니 적립</h1>
                            <p>
                               
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			<x-row>
				<x-col-6>
					<x-card>
						<x-card-body>
							{formstart}

							<x-form-hor>
								<x-form-label>이메일</x-form-label>
								<x-form-item>{email}</x-form-item>
							</x-form-hor>

							입금 계좌 안내

							<x-form-hor>
								<x-form-label>은행명</x-form-label>
								<x-form-item>{bankname}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>계좌번호</x-form-label>
								<x-form-item>{banknum}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>예금주</x-form-label>
								<x-form-item>{bankuser}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>입금금액</x-form-label>
								<x-form-item>{emoney}</x-form-item>
							</x-form-hor>

							{form_submit}
							{formend}

						</x-card-body>
					</x-card>
				</x-col-6>
			</x-row>

			
		</x-container>
	</x-main-content>
</x-theme>