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

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-body>
                            {formstart}

                            <x-form-hor>
								<x-form-label>가입경로</x-form-label>
								<x-form-item>{regref}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>이메일</x-form-label>
								<x-form-item>{email}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>비밀번호</x-form-label>
								<x-form-item>{password}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>이름(last name):</x-form-label>
								<x-form-item>{manager}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>성(first name)</x-form-label>
								<x-form-item>{firstname}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>성별</x-form-label>
								<x-form-item>{sex}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>전화번호</x-form-label>
								<x-form-item>{phone}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>도시</x-form-label>
								<x-form-item>{city}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>주(state)</x-form-label>
								<x-form-item>{state}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>우편번호</x-form-label>
								<x-form-item>{post}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>주소</x-form-label>
								<x-form-item>{address}</x-form-item>
							</x-form-hor>

                            회원 승인:

                            <x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{enable}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>국가</x-form-label>
								<x-form-item>{country}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>언어</x-form-label>
								<x-form-item>{language}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>이머니</x-form-label>
								<x-form-item>{emoney}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>포인트</x-form-label>
								<x-form-item>{point}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>구매 할인율</x-form-label>
								<x-form-item>{discount}%</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>가입일자</x-form-label>
								<x-form-item>{regdate}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>마지막 접속일</x-form-label>
								<x-form-item>{lastlog}</x-form-item>
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
