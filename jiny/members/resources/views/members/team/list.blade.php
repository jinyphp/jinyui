<div>
    <x-row>
		<div class="col-1">
			<x-list>
				<x-list-item>우측메뉴</x-list-item>
				<x-list-item>
					<x-link href="/admin/members/list">회원목록</x-link>
					
				</x-list-item>
				<x-list-item>회원정보</x-list-item>
				<x-list-item>
					<x-link href="/admin/members/agreements">동의서</x-link>
				</x-list-item>
				<x-list-item>동의서 기록</x-list-item>
				<x-list-item>블랙리스트</x-list-item>
				<x-list-item>예약키워드</x-list-item>
				<x-list-item>레벨</x-list-item>
				<x-list-item>그룹</x-list-item>
				<x-list-item>팀</x-list-item>

				<x-list-item>적립금</x-list-item>
				<x-list-item>포인트</x-list-item>

				<x-list-item>휴먼회원</x-list-item>

				<x-list-item>이메일발송</x-list-item>
				<x-list-item>발송양식</x-list-item>
				<x-list-item>믄자메시지</x-list-item>

				<x-list-item>회원설정</x-list-item>

				<x-list-item>비밀번호 재설정</x-list-item>
				<x-list-item>로그인기록</x-list-item>
				<x-list-item>권한</x-list-item>
				<x-list-item>소셜로그인</x-list-item>
				<x-list-item>추천관리</x-list-item>
				<x-list-item>계층관리</x-list-item>
			</x-list>
		</div>
		<div class="col-11">
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
                        	<h1 class="h3 d-inline align-middle">팀</h1>
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
		
	</x-row>



</div>