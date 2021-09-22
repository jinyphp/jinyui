<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>

            <h1>{{ $nested->title }}</h1>
            
{{ currentRouteName() }}

    <!-- contents -->
    <x-row>
        <x-col>
            <x-card>
                <x-card-body>
                    <h5 class="card-title">사용자를 등록합니다.</h5>
                    <h6 class="card-subtitle text-muted"></h6>

                    <x-form action="{{ route(currentRouteName().'.store',[ $nested->id ]) }}" method="post">
                        @csrf
                        <input type="hidden" name="nested_id" value="{{$nested->id}}"/>
                        <input type="hidden" name="_method" value="PUT">
                        

                        <x-form-row>
                            <x-form-label>타이틀</x-form-label>
                            <x-form-item>
                                <x-input type="text" name="title">
                                    @if (isset($row->title))
                                        {{ $row->title }} 
                                    @endif
                                </x-input>
                                <div class="form-text">목록, 입력항목 타이틀입니다.</div>
                            </x-form-item>
                        </x-form-row>

                        <x-row>
                            {{--목록--}}
                            <x-col-6>                                
                                <x-form-row>
                                    <x-form-label>list</x-form-label>
                                    <x-form-item>
                                        <x-checkbox name="list"/>
                                        <div class="form-text">선택시 본항목을 목록에 출력합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>list_type</x-form-label>
                                    <x-form-item>
                                        <x-select name="list_type">
                                            <x-option value="field">필드값</x-option>
                                            <x-option value="html">문자열</x-option>
                                            <x-option value="link">링크</x-option>
                                        </x-select>
                                        
                                        <div class="form-text">정렬을 선택합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>list_value</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="list_value"/>
                                        <div class="form-text">필드명 또는 링크, HTML 코드를 삽입합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>list_sort</x-form-label>
                                    <x-form-item>
                                        <x-select name="list_sort">
                                            <x-option value="">none</x-option>
                                            <x-option value="desc">desc</x-option>
                                            <x-option value="asc">asc</x-option>
                                        </x-select>
                                        
                                        <div class="form-text">정렬을 선택합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>list_pos</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="list_pos"/>
                                        <div class="form-text">출력 순서를 지정합니다.</div>
                                    </x-form-item>
                                </x-form-row>


                                <x-form-row>
                                    <x-form-label>filters</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="filters"/>
                                        <div class="form-text">검색을 허용합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>filter_pos</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="filter_pos"/>
                                        <div class="form-text">검색표시 순서를 지정합니다.</div>
                                    </x-form-item>
                                </x-form-row>
                            </x-col-6>
                            {{--폼 입력 및 수정--}}
                            <x-col-6>
                                <x-form-row>
                                    <x-form-label>폼입력</x-form-label>
                                    <x-form-item>
                                        <x-checkbox name="form"/>
                                        <div class="form-text">폼 입력을 허용합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>Input</x-form-label>
                                    <x-form-item>
                                        <x-select name="input">
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

                                <x-form-row>
                                    <x-form-label>유형</x-form-label>
                                    <x-form-item>
                                        <x-select name="select_type">
                                            <x-option value="key">Key:title;</x-option>
                                            <x-option value="table">DB Table</x-option>
                                        </x-select>
                                        <div class="form-text">select 출력 유형을 지정합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>유형값</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="select_value"/>
                                        <div class="form-text">테이블명 또는 키:값; 문자열을 입력합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                {{-- select/radio 선택--}}

                                <x-form-row>
                                    <x-form-label>이름</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="name"/>
                                        <div class="form-text">폼 항목의 이름을 지정합니다.</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>placeholder</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="placeholder"/>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>default</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="input_default"/>
                                        <div class="form-text">기본값을 설정합니다..</div>
                                    </x-form-item>
                                </x-form-row>

                                <x-form-row>
                                    <x-form-label>form_pos</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="form_pos"/>
                                    </x-form-item>
                                </x-form-row>
                            </x-col-6>
                        </x-row>

                        <x-row>
                            <x-col-12>
                                <x-form-row>
                                    <x-form-label>description</x-form-label>
                                    <x-form-item>
                                        <x-input type="text" name="description"/>
                                    </x-form-item>
                                </x-form-row>
                            </x-col-12>
                        </x-row>



                        <x-button type="submit" name="_submit" primary>필드추가</x-button>


                    </x-form>

                </x-card-body>
            </x-card>
        </x-col>
    </x-row>
    <!-- end of contents -->

        </x-container>
	</x-main-content>
</x-theme>
