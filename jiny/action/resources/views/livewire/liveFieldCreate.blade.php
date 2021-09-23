
<x-form method="post">
    
    <x-form-row>
        <x-form-label>타이틀</x-form-label>
        <x-form-item>
            <x-input type="text" name="title" wire:model="_data.title"></x-input>
            <div class="form-text">목록, 입력항목 타이틀입니다.</div>
        </x-form-item>
    </x-form-row>

    <x-row>
        {{--목록--}}
        <x-col-6>                                
            <x-form-hor>
                <x-form-label>list</x-form-label>
                <x-form-item>
                    <x-checkbox name="list" wire:model="_data.list"/>
                    <span class="form-text">선택시 본항목을 목록에 출력합니다.</span>
                </x-form-item>
            </x-form-hor>

            <x-form-hor>
                <x-form-label>list_pos</x-form-label>
                <x-form-item>
                    {!! xSelect("list_pos")
                        ->setAttribute('wire:model',"_data.list_pos")
                        ->rangeOption(20)
                        ->setWidth('tiny') !!}                    
                    <div class="form-text">출력 순서를 지정합니다.</div>
                </x-form-item>
            </x-form-hor>


            <x-row>
                <x-col-6>

                    <x-form-row>
                        <x-form-label>목록 출력타입</x-form-label>
                        <x-form-item>
                            {!! xSelect("list_type")
                                ->setAttribute('wire:model',"_data.list_type")
                                ->addOption("테이블 필드", "field")
                                ->addOption("HTML 코드", "html")
                                ->addOption("링크주소 생성", "link")
                                ->setWidth('medium') !!}
                            <div class="form-text">목록에 출력하는 데이터 타입을 지정합니다.</div>
                        </x-form-item>
                    </x-form-row>
                </x-col-6>
                <x-col-6>
                    @if (isset($_data['list_type']) && $_data['list_type'] == "field")
                        <x-form-row>
                            <x-form-label>출력필드</x-form-label>
                            <x-form-item>
                                <x-input type="text" name="list_value" wire:model="_data.list_value"/>
                                <div class="form-text">목록에 출력할 필드명을 지정합니다.</div>
                            </x-form-item>
                        </x-form-row>

                        <x-form-row>
                            <x-form-label>list_sort</x-form-label>
                            <x-form-item>
                                <x-select name="list_sort" wire:model="_data.list_sort">
                                    <x-option value="">none</x-option>
                                    <x-option value="desc">desc</x-option>
                                    <x-option value="asc">asc</x-option>
                                </x-select>
                                
                                <div class="form-text">정렬을 선택합니다.</div>
                            </x-form-item>
                        </x-form-row>

                        <x-form-row>
                            <x-form-label>list_edit</x-form-label>
                            <x-form-item>
                                <x-checkbox name="list_edit" wire:model="_data.list_edit"/>
                                <div class="form-text">.</div>
                            </x-form-item>
                        </x-form-row>
                    @endif

                    @if (isset($_data['list_type']) && $_data['list_type'] == "html")
                        <x-form-row>
                            <x-form-label>HTML 출력</x-form-label>
                            <x-form-item>
                                <textarea name="list_value" wire:model="_data.list_value">
                                    {{$_data['list_type']}}
                                </textarea>
                                <div class="form-text">목록에 출력될 HTML 코드를 작성합니다.</div>
                            </x-form-item>
                        </x-form-row>
                    @endif

                    @if (isset($_data['list_type']) && $_data['list_type'] == "link")
                        <x-form-row>
                            <x-form-label>링크주소</x-form-label>
                            <x-form-item>
                                <x-input type="text" name="list_value" wire:model="_data.list_value"/>
                                <div class="form-text">링크주소를 입력합니다..</div>
                            </x-form-item>
                        </x-form-row>

                        <x-form-row>
                            <x-form-label>링크 텍스트</x-form-label>
                            <x-form-item>
                                <x-input type="text" name="list_link_text" wire:model="_data.list_link_text"/>
                                <div class="form-text">링크 텍스트를 지정합니다.</div>
                            </x-form-item>
                        </x-form-row>
                    @endif
                </x-col-6>
            </x-row>
            
            <x-form-row>
                <x-form-label>목록 스타일</x-form-label>
                <x-form-item>
                    <x-input type="text" name="list_style" wire:model="_data.list_style"/>
                    <div class="form-text">테이블 td셀에 적용할 CSS를 지정합니다.</div>
                </x-form-item>
            </x-form-row>


            <x-form-row>
                <x-form-label>filters</x-form-label>
                <x-form-item>
                    <x-checkbox name="list" wire:model="_data.filters"/>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>filter_pos</x-form-label>
                <x-form-item>
                    {!! xSelect("filter_pos")
                        ->setAttribute('wire:model',"_data.filter_pos")
                        ->rangeOption(20)
                        ->setWidth('tiny') !!}
                    <div class="form-text">검색표시 순서를 지정합니다.</div>
                </x-form-item>
            </x-form-row>
        </x-col-6>
        {{--폼 입력 및 수정--}}
        <x-col-6>
            <x-form-row>
                <x-form-label>폼입력</x-form-label>
                <x-form-item>
                    <x-checkbox name="form" wire:model="_data.form"/>
                    <div class="form-text">폼 입력을 허용합니다.</div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>이름</x-form-label>
                <x-form-item>
                    <x-input type="text" name="name" wire:model="_data.name"/>
                    <div class="form-text">폼 항목의 이름을 지정합니다.</div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>Input</x-form-label>
                <x-form-item>
                    <x-select name="input" wire:model="_data.input">
                        <optgroup label="입력">
                            <x-option value="text">text</x-option>
                            <x-option value="email">email</x-option>
                            <x-option value="password">password</x-option>
                            <x-option value="number">number</x-option>
                            <x-option value="textarea">texarea</x-option>
                            <x-option value="hidden">hidden</x-option>
                        </optgroup>
                        <optgroup label="선택">
                            <x-option value="select">select</x-option>
                            <x-option value="radio">radio</x-option>
                            <x-option value="color">color</x-option>
                            <x-option value="checkbox">checkbox</x-option>
                        </optgroup>                                          
                    </x-select>
                    <div class="form-text">폼 입력 유형을 지정합니다.</div>
                </x-form-item>
            </x-form-row>

            {{-- select/radio 선택--}}
            @if (isset($_data['input']) && $_data['input'] == "select")
                <x-form-row>
                    <x-form-label>선택 데이터 유형</x-form-label>
                    <x-form-item>
                        <x-select name="select_type" wire:model="_data.select_type">
                            <x-option value="key">Key:title;로 선택항목을 생성.</x-option>
                            <x-option value="table">DB Table을 통하여 선택항목을 생성</x-option>
                        </x-select>
                        <div class="form-text">선택출력 유형을 지정합니다.</div>
                    </x-form-item>
                </x-form-row>

                <x-form-row>
                    <x-form-label>유형값</x-form-label>
                    <x-form-item>
                        <x-input type="text" name="select_value" wire:model="_data.select_value"/>
                        <div class="form-text">테이블명 또는 키:값; 문자열을 입력합니다.</div>
                    </x-form-item>
                </x-form-row>
            @endif


            {{-- select/radio 선택--}}
            @if (isset($_data['input']) &&
                ($_data['input'] == "text" || $_data['input'] == "email" || $_data['input'] == "password"
                || $_data['input'] == "number" || $_data['input'] == "textarea")
            )
                <x-form-row>
                    <x-form-label>placeholder</x-form-label>
                    <x-form-item>
                        <x-input type="text" name="placeholder" wire:model="_data.placeholder"/>
                    </x-form-item>
                </x-form-row>
            @endif

            <x-form-row>
                <x-form-label>default</x-form-label>
                <x-form-item>
                    <x-input type="text" name="input_default" wire:model="_data.input_default"/>
                    <div class="form-text">기본값을 설정합니다..</div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>유효성검증</x-form-label>
                <x-form-item>
                    <x-input type="text" name="validate" wire:model="_data.validate"/>
                    <div class="form-text">유효성 검사를 위한 조건을 입력하세요.</div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>form_pos</x-form-label>
                <x-form-item>
                    {!! xSelect("form_pos")
                        ->setAttribute('wire:model',"_data.form_pos")
                        ->rangeOption(20)
                        ->setWidth('tiny') !!}
                    
                </x-form-item>
            </x-form-row>
        </x-col-6>
    </x-row>

    <x-row>
        <x-col-12>
            <x-form-row>
                <x-form-label>description</x-form-label>
                <x-form-item>
                    {!! 
                        xTextarea("description")
                        ->setAttribute('wire:model.deafer',"_data.description")
                    !!}
                </x-form-item>
            </x-form-row>
        </x-col-12>
    </x-row>


    @if (isset($rules['edit_id']))
        <x-button danger wire:click="delete">삭제(F4)</x-button>
        <x-button info wire:click="update">수정(F3)</x-button>
    @else
        <x-button secondary wire:click="clear">취소</x-button>
        <x-button primary wire:click="store">등록(F2)</x-button>
    @endif


</x-form>