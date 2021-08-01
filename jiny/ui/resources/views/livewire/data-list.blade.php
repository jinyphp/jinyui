<div x-data="datatables()">
    {{-- 조건검색 필터 --}}
    <x-tab>
        
        @foreach ($filter_forms as $name => $tab)            
            <x-tab-item :name="$name">
                @if ($loop->first)
                    <x-slot name="selected">checked</x-slot>
                @endif
                
                @foreach ($tab as $key => $item)
                    <x-forms.row>
                        <x-forms.item-end class="w-1/3">
                            <x-forms.label> {{$item['title']}}</x-forms.label>
                        </x-forms.item-end>
                        <x-forms.item class="w-2/3">
                            <x-forms.text wire:model.defer="filter.{{$key}}"></x-forms.text>
                        </x-forms.item>
                    </x-forms.row>
                @endforeach
            </x-tab-item>
        @endforeach

        <x-tab-item name="display">
            <x-forms.row>
                <x-forms.item-end class="w-1/3">
                    <x-forms.label> 목록출력 </x-forms.label>
                </x-forms.item-end>
                <x-forms.item class="w-2/3">
                    <select name="listnum" wire:model="listnum">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="1000">1000</option>
                    </select>
                </x-forms.item>
            </x-forms.row>
        </x-tab-item>

        <div class="flex-none w-full p-2">
            <div class="border-t pt-2 flex flex-row justify-center">
                <div class="mr-1">
                    <x-button class="btn-blue" wire:click="search">{{ __('필터조건(F3)') }}</x-button>
                </div>
                <div class="ml-1">
                    <x-button class="btn-alt-blue" wire:click="search_reset">{{ __('초기화(F5)') }}</x-button>
                </div>
            </div>
        </div>        
    </x-tab>

    



    {{-- 테이블 --}}
    <div>
        <table class="datatable table">
            {{-- 해더타이틀 --}}
            <thead>
                <tr>
                    <th class="check">
                        <input type="checkbox" id="all_checks" name="all_checks" value="1"
                                class="checkbox-radio" 
                                @click="selectAll($event);">
                        <label for="all_checks">
                            <span></span>
                        </label>
                    </th>
                            
                    @foreach ($table_title as $item)
                        <th pos="{{$item['list_pos']}}">
                            {{$item['title']}}
                            @if ($item['list_sort'])
                                <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            @endif                            
                        </th>                         
                    @endforeach

                    <th class="w-4">
                        <button wire:click="editField">
                            <x-icon-cog class="h-4 w-4" />
                        </button>                        
                    </th>
                </tr>
            </thead>

            {{-- 테이블 데이터--}}
            <tbody>
                <form>
                    @csrf
                    @if ($rows->count())
                        @foreach ($rows as $item)
                        <tr>
                            <td class="check">
                                <input type="checkbox" id="ids_{{$item->id}}" name="ids" 
                                    value="{{$item->id}}"
                                        class="checkbox-radio rowCheckbox"
                                        @click="selectCheck($event, {{$item->id}})">
                                <label for="ids_{{$item->id}}">
                                    <span></span>
                                </label>
                            </td>

                            @foreach ($forms as $key => $field)
                                @if ($field['display_list'])
                                    <td class="">
                                        @if (isset($field['edit']) && $field['edit'])
                                            <a class="cursor-pointer text-blue-500 hover:underline" wire:click="edit({{$item->id}})">
                                                {{$item->$key}}
                                            </a>
                                        @else
                                            {{$item->$key}}
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            
                            <td></td>
                        </tr>
                        @endforeach
                    @else

                        <tr><td colspan="{{count($forms)}}">
                            @if ($search_status)
                            일치하는 조건이 없습니다.
                            @else
                            데이터가 없습니다.
                            @endif
                            
                        </td></tr>

                    @endif
                </form>
            </tbody>
        </table>
    </div>

    {{-- 페이지네이션 --}}
    <div class="flex flex-row justify-between items-center">
        <div>
            <button class="btn-icon btn-danger" disabled id="btn_select_delete" @click="selectDelete($event);">
                <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                {{ __('삭제') }}
            </button>

            <span id="selected_count" class="mr-2"></span>
        </div>
        <div class="flex-grow px-2">
            {{ $rows->links('components.pagination') }}
        </div>
        <div>
            {{-- 추가등록 버튼--}}
            <button class="btn btn-blue" wire:click="create">
                <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ __('추가') }}
            </button>
        </div>
    </div>
    

    <button wire:click="dialog">
    newAdd
    </button>
    
    <x-jinyui::dialog maxWidth="5xl" wire:model="dialogVisible">
        @livewire('data-form',['table'=>$table, 'conf'=>$conf])
    </x-jinyui::dialog>
















    {{-- 모달창 --}}
    <x-jinyui::modal-form wire:model="modalFormVisible">

        <x-slot name="title">
            {{ __($title) }}
            @if ($mode == "new")
            추가
            @endif
        </x-slot>

        <x-slot name="content">

            <x-forms.inline>
                <x-slot name="label">
                    <x-forms.label>활성화</x-forms.label>
                </x-slot>
                <x-slot name="item">
                    <x-forms.checkbox checked="checked" wire:model="_enable">
                    </x-forms.checkbox>
                </x-slot>
                <x-slot name="description">
                    설명...
                </x-slot>
            </x-forms.inline>

   
           
            @foreach ($forms as $key => $item)
                <x-forms.inline>
                    <x-slot name="label">
                        
                        <x-forms.label>{{$item['title']}}</x-forms.label>
                        
                    </x-slot>
                    <x-slot name="item">
                        
                        
                        <x-forms.text wire:model="data.{{$key}}"></x-forms.text>
                        
                    </x-slot>
                    <x-slot name="description">
                        설명...
                    </x-slot>
                </x-forms.inline>
            @endforeach
            
      

        </x-slot>

        <x-slot name="footer">

            @if ($mode == "new")
                <x-button-outline wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('취소') }}
                </x-jet-secondary-button>

            @else
                <x-button-outline wire:click="delete" wire:loading.attr="disabled">
                    {{ __('삭제') }}
                </x-jet-secondary-button>
            @endif

            @if ($_id)
                <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                    {{ __('수정') }}
                </x-jet-danger-button>
                
            @else
                <x-button class="ml-2 btn-blue" wire:click="insert" wire:loading.attr="disabled">
                    {{ __('등록') }}
                </x-jet-danger-button>
            @endif
                
        </x-slot>

        {{-- @livewire('data-new') --}}
    </x-jinyui::modal-form>
    
</div>



{{-- 스크립트(Alpin.js) --}}
<script>
    function datatables() {
        return {
            selectedRows: [],

            selectCheck(event, id) {
                
                // 선택아이템 체크
                let rows = this.selectedRows;
                if (rows.includes(id)) {
                    let index = rows.indexOf(id);
                    rows.splice(index, 1);
                } else {
                    rows.push(id);
                }

                
                this.selected_count(rows.length);
                

                // 삭제버튼                
                if ( rows.length > 0 ) {
                    this.btn_delete_enable();
                } else {
                    this.btn_delete_disable();
                }
                
                

                // 전체선택 여부 확인
                let columns = document.querySelectorAll('.rowCheckbox');
                let allcheck = document.querySelector('#all_checks');
                if(columns.length == rows.length) {
                    allcheck.checked = true;
                } else {
                    allcheck.checked = false;
                }

                // 활성화 체크
                let tr = event.target.parentElement.parentElement; // td->tr 선택
                if(event.target.checked) {
                    tr.classList.add('row-selected');
                } else {
                    tr.classList.remove('row-selected');
                }

            },

            selectAll($event) {
                let columns = document.querySelectorAll('.rowCheckbox');
                let tr;
                this.selectedRows = [];

                // 선택삭제
                //let delBtn = document.querySelector('#btn-delete');

                if ($event.target.checked == true) {
                    // 전체선택
                    columns.forEach(column => {
                        column.parentElement.parentElement.classList.add('row-selected');                    
                        column.checked = true;
                        this.selectedRows.push(parseInt(column.name));
                    });

                    
                    this.btn_delete_enable();
                    this.selected_count(columns.length);

                } else {
                    // 전체해제
                    columns.forEach(column => {
                        column.parentElement.parentElement.classList.remove('row-selected'); 
                        column.checked = false
                    });
                    this.selectedRows = [];

                    this.btn_delete_disable();
                    this.selected_count(0);
                }
            },

            selectDelete($event) {
                // alert("delete");
                // 체크된 항목만 선택
                let check = document.querySelectorAll('input[name=ids]:checked');
                
                // 항목의 value값만을 추출하여 배열에 저장
                let item = [];
                check.forEach(el=>{
                    //console.log(el.attributes.value);
                    item.push(parseInt(el.attributes.value.value))
                });
                // console.log(item);

                if (confirm("are you delete")) {
                    let url = "/company";
                    let token = document.querySelector('input[name=_token]').value;

                    //console.log(token);
                    
                    fetch(url, {
                        method: 'DELETE',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            _token: token,
                            sitename: 'webisfree',
                            ids:item
                        })
                    }).then(function(response) {
                        response.json().then(function(json) {
                            // process your JSON further
                            //console.log(json);
                            Livewire.emit('refeshTable');
                        });
                    }).catch(function(error) {
                        // Error
                        //console.log(error);
                    });
                }
            },
            selected_count(count)
            {
                let checknum = document.querySelector('#selected_count');
                if(checknum) {
                    checknum.textContent = count + " selected";
                }
            },
            btn_delete_enable()
            {
                let delBtn = document.querySelector('#btn_select_delete');
                if(delBtn) {
                    delBtn.removeAttribute('disabled');
                }
                
            },
            btn_delete_disable()
            {
                let delBtn = document.querySelector('#btn_select_delete');
                if(delBtn) {
                    delBtn.setAttribute('disabled',null);
                }                
            }

            //
        }
    }
</script>


