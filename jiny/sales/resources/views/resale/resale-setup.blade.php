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
                        	<h1 class="h3 d-inline align-middle">입점설정</h1>
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

			<table border="0" width="978" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">입점기능 허용 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{resales}</td>
					<td style="font-size:12px;padding:10px;" width="718" colspan="2">
					내 쇼핑몰에 입점기능을 허용 및 조건을 설정합니다.</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">입점커미션 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{comission}</td>
					<td style="font-size:12px;padding:10px;" width="718" colspan="2">
					카테고리 수수료 외, 기본 입점 판매 수수료</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">입점 로고 :</td>
					<td style="font-size:12px;padding:10px;" width="300" colspan="2">
					{logo}</td>
					<td style="font-size:12px;padding:10px;" width="589">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">입점 설명 :</td>
					<td style="font-size:12px;padding:10px;" width="100">&nbsp;</td>
					<td style="font-size:12px;padding:10px;" width="200">&nbsp;</td>
					<td style="font-size:12px;padding:10px;" width="589">&nbsp;</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">{description}</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					공급자 정보 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					외부 사이트 제품 공급 및 판매 공급자 정보</td>
					</tr>
	</table>
			<table border="0" width="978" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">공급자명 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{seller}</td>
					<td style="font-size:12px;padding:10px;" width="100">이메일 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{email}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">연동 사이트 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{name}</td>
					<td style="font-size:12px;padding:10px;" width="100">url :</td>
					<td style="font-size:12px;padding:10px;" width="200">{domain}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">연락처 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{seller_phone}</td>
					<td style="font-size:12px;padding:10px;" width="100">팩스 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{seller_fax}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">발송주소 :</td>
					<td style="font-size:12px;padding:10px;" width="500" colspan="3">
					{address_send}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">반품주소 :</td>
					<td style="font-size:12px;padding:10px;" width="500" colspan="3">
					{address_return}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			</table>

			{form_submit}{formend}

			
		</x-container>
	</x-main-content>
</x-theme>