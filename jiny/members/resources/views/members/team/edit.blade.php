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
                <a href="{{route($rules['routename'].".index")}}" class="btn btn-primary">목록</a>
            </div>
        </div>
    </div>

    <x-row>
        <x-col>
            <x-card>
                <x-card-body>
                    <h5 class="card-title">팀을 등록합니다.</h5>
                    <h6 class="card-subtitle text-muted"></h6>

                    <x-form-hor>
                        <x-form-label>활성화</x-form-label>
                        <x-form-item>
                            {!! xCheckbox("enable")->setAttribute("wire:model.defer","_data.enable") !!}
                        </x-form-item>
                    </x-form-hor>

                    <x-form-hor>
                        <x-form-label>등록일자</x-form-label>
                        <x-form-item>
                            {!! xInputText('regdate')->setWidth("standard")->setAttribute("wire:model.defer","_data.regdate") !!}
                        </x-form-item>
                    </x-form-hor>

                    <x-form-hor>
                        <x-form-label>팀명</x-form-label>
                        <x-form-item>
                            {!! xInputText('team')->setWidth("standard")->setAttribute("wire:model.defer","_data.team") !!}
                        </x-form-item>
                    </x-form-hor>

                    <x-form-hor>
                        <x-form-label>설명</x-form-label>
                        <x-form-item>
                            {!! xTextarea('description')->setWidth("standard")->setAttribute("wire:model.defer","_data.description") !!}
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
        </x-col>
    </x-row>

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
