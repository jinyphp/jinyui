<div>
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
                <a href="{{route($rules['routename'].".index")}}" class="btn btn-primary">목록</a>
            </div>
        </div>
    </div>


    <x-card>
        <x-card-body>
    
                <h5 class="card-title">기본정보</h5>
                <h6 class="card-subtitle text-muted">사이트 접속에 필요한 회원 정보를 입력합니다.</h6>

                <x-form-hor>
                    <x-form-label>Role</x-form-label>
                    <x-form-item>
                        {!! xSelect()->setWidth("standard")
                            ->addTable("admin_roles", 'title')
                            ->setSelected('사용자') !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>가입경로(regref)</x-form-label>
                    <x-form-item>
                        {!! xInputText('regref')->setWidth("small")->setAttribute("wire:model.defer","_data.refref") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>이메일(email)</x-form-label>
                    <x-form-item>
                        {!! xInputEmail('email')->setWidth("standard")->setAttribute("wire:model.defer","_data.email") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>비밀번호(password)</x-form-label>
                    <x-form-item>
                        {!! xInputPassword('password')->setWidth("small")->setAttribute("wire:model.defer","_data.password") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>이름(last name):</x-form-label>
                    <x-form-item>
                        {!! xInputText('lastname')->setWidth("standard")->setAttribute("wire:model.defer","_data.lastname") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>성(first name)</x-form-label>
                    <x-form-item>
                        {!! xInputText('firstname')->setWidth("standard")->setAttribute("wire:model.defer","_data.firstname") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>성별</x-form-label>
                    <x-form-item>
                        {!! xRadioGroup()
                            ->addRadio(
                                xRadio("sex", "man")->setAttribute("wire:model.defer","_data.sex"), 
                                "남성")
                            ->addRadio(
                                xRadio("sex", "woman")->setAttribute("wire:model.defer","_data.sex"), 
                                "여성")
                            ->addRadio(
                                xRadio("sex", "company")->setAttribute("wire:model.defer","_data.sex"), 
                                "법인")
                            ->setInline()
                            
                        !!}
                    </x-form-item>
                </x-form-hor>

                {{--
                <x-form-hor>
                    <x-form-label>성별</x-form-label>
                    <x-form-item>
                        <input type="radio" name="marry" value="single" wire:model.defer="_data.marry">
                        <input type="radio" name="marry" value="married" wire:model.defer="_data.marry">
                    </x-form-item>
                </x-form-hor>
                --}}

                <x-form-hor>
                    <x-form-label>전화번호</x-form-label>
                    <x-form-item>
                        {!! xInputText('phone')->setWidth("standard")->setAttribute("wire:model.defer","_data.phone") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>도시</x-form-label>
                    <x-form-item>
                        {!! xInputText('city')->setWidth("standard")->setAttribute("wire:model.defer","_data.ciry") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>주(state)</x-form-label>
                    <x-form-item>
                        {!! xInputText('state')->setWidth("standard")->setAttribute("wire:model.defer","_data.state") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>우편번호</x-form-label>
                    <x-form-item>
                        {!! xInputText('post')->setWidth("standard")->setAttribute("wire:model.defer","_data.post") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>주소</x-form-label>
                    <x-form-item>
                        {!! xInputText('address')->setWidth("standard")->setAttribute("wire:model.defer","_data.address") !!}
                    </x-form-item>
                </x-form-hor>

                <h5 class="card-title">회원 승인</h5>
                <h6 class="card-subtitle text-muted"></h6>

                <x-form-hor>
                    <x-form-label>승인</x-form-label>
                    <x-form-item>
                        {!! xCheckbox("auth")->setAttribute("wire:model.defer","_data.auth") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>국가</x-form-label>
                    <x-form-item>
                        {!! xInputText('country')->setWidth("standard")->setAttribute("wire:model.defer","_data.country") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>언어</x-form-label>
                    <x-form-item>
                        {!! xInputText('language')->setWidth("standard")->setAttribute("wire:model.defer","_data.language") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>이머니</x-form-label>
                    <x-form-item>
                        {!! xInputText('emoney')->setWidth("standard")->setAttribute("wire:model.defer","_data.emoney") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>포인트</x-form-label>
                    <x-form-item>
                        {!! xInputText('point')->setWidth("standard")->setAttribute("wire:model.defer","_data.point") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>구매 할인율</x-form-label>
                    <x-form-item>
                        {!! xInputText('discount')->setWidth("standard")->setAttribute("wire:model.defer","_data.discount") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>가입일자</x-form-label>
                    <x-form-item>
                        {!! xInputText('regdate')->setWidth("standard")->setAttribute("wire:model.defer","_data.regdate") !!}
                    </x-form-item>
                </x-form-hor>

                <x-form-hor>
                    <x-form-label>마지막 접속일</x-form-label>
                    <x-form-item>
                        {!! xInputText('lastlog')->setWidth("standard")->setAttribute("wire:model.defer","_data.lastlog") !!}
                    </x-form-item>
                </x-form-hor>


                {{-- --}}
                <x-form-hor>
                    <x-form-label></x-form-label>
                    <x-form-item>
                        @if (isset($rules['edit_id']))
                            <x-modal-button danger data-bs-target="#delete-id-popup">
                                삭제(F4)
                            </x-modal-button>
                            <x-button info wire:click="update">수정(F3)</x-button>
                        @else
                            <x-button info outline wire:click="storeReset">취소</x-button>
                            <x-button primary wire:click="store">등록(F2)</x-button>
                        @endif
                    </x-form-item>
                </x-form-hor>


                

        </x-card-body>
    </x-card>


    {{-- 팝업 삭제 확인창 --}}
    <x-modal-layout small id="delete-id-popup">
        <x-modal-header>
            <h5 class="modal-title">확인</h5>
        </x-modal-header>
        <x-modal-body>
            항목을 삭제합니다.
        </x-modal-body>
        <x-modal-footer>
            <x-button secondary data-bs-dismiss="modal">
                취소
            </x-button>
            <x-button danger data-bs-dismiss="modal" id="btn-delete" 
                wire:click="delete">
                확인
            </x-button>
        </x-modal-footer>
    </x-modal-layout>
</div>