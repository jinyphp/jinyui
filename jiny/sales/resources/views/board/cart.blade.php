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
                        	<h1 class="h3 d-inline align-middle">장바구니</h1>
                            <p>
                                장바구니 저장기간은 10일입니다. 10일이 초과된 상품은 자동으로 관심상품으로 이동됩니다.
								장바구니 저장가능 상품 개수는 30개입니다. 30개 이상의 상품을 담으면 가장 오래 저장된 상품이 자동으로 관심상품으로 이동됩니다.
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->



			{cart_list}

			주문안내

			입금계좌번호 및 결제방법

			고객센터 및 문의

			
		</x-container>
	</x-main-content>
</x-theme>
