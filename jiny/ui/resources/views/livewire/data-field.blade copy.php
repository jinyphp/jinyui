<div>

    {{-- 모달창 --}}
    <x-jinyui-modal-list maxWidth="5xl" zindex="10" wire:model="modalFieldVisible">

        <x-slot name="title">
            <svg class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
            </svg>
            필드설정
        </x-slot>
        <x-slot name="close">
            <button wire:click="$toggle('modalFieldVisible')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">
       
            <table class="datatable table">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>활성화</th>
                        <th>타이틀</th>
                        <th>컬럼명</th>
                        <th>정렬</th>
                        <th>편집</th>
                        <th>조건필터</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_array($conf))
                        @foreach ($conf as $key => $arr)
                        <tr draggable="true">
                            <td>{{$key+1}}</td>
                            <td>
                                @if ($arr['_list'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._list" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._list" value="false">
                                @endif
                                
                            </td>
                            <td>
                                <input type="text" wire:model="conf.{{$key}}._title"
                                class="px-2 py-1 text-xs">                                
                            </td>
                            <td>
                                <input type="text" wire:model="conf.{{$key}}._code"
                                class="px-2 py-1 text-xs">
                            </td>
                            <td>
                                @if ($arr['_list_sort'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_sort" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_sort" value="false">
                                @endif
                                
                            </td>
                            <td>
                                @if ($arr['_list_sort'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._edit" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._edit" value="false">
                                @endif
                                
                            </td>
                            <td>
                                @if ($arr['_list_filter'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_filter" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_filter" value="false">
                                @endif
                                
                            </td>
                            <td>
                                <button class="text-red-700 px-2"
                                    wire:click.prevent="removeField({{$key}})">
                                    <svg class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>                                
                            </td>
                        </tr>    
                        @endforeach

                        {{--
                        @if ($add_new_field)
                        @php
                            $key++;
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if ($arr['_enable'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._enable" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._enable" value="false">
                                @endif
                                
                            </td>
                            <td>
                                <input type="text" wire:model="conf.{{$key}}._title"
                                class="px-2 py-1 text-xs">                                
                            </td>
                            <td>
                                <input type="text" wire:model="conf.{{$key}}._code"
                                class="px-2 py-1 text-xs">
                            </td>
                            <td>
                                @if ($arr['_list_sort'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_sort" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_sort" value="false">
                                @endif
                                
                            </td>
                            <td>
                                @if ($arr['_edit'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._edit" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._edit" value="false">
                                @endif
                                
                            </td>
                            <td>
                                @if ($arr['_list_filter'])
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_filter" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}._list_filter" value="false">
                                @endif
                                
                            </td>
                            <td>
                                <button class="text-red-700 px-2"
                                    wire:click.prevent="$toggle('add_new_field')">
                                    <svg class="h-4 w-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr> 
                        @endif
                        --}}
                    @endif
                    
                </tbody>
            </table>

            {{-- 추가버튼 
            @if (!$add_new_field)
                <div class="flex justify-center p-4">
                    <button clsaa="text-green-700 px-2"
                        wire:click.prevent="newField">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    </button>
                </div>
            @endif
            --}}
            
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row justify-between">
                <x-button class="ml-2 btn-blue" wire:click="newField" wire:loading.attr="disabled">
                    <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    {{ __('필드추가') }}
                </x-jet-danger-button>

                <x-button class="ml-2 btn-blue" wire:click="save" wire:loading.attr="disabled">
                    {{ __('적용') }}
                </x-jet-danger-button>
            </div>           
        </x-slot>
        
    </x-jinyui-modal-list>










    
    <x-jinyui::modal-list maxWidth="7xl" wire:model="modalFieldEditVisible">
        <x-slot name="title">
            필드수정
        </x-slot>
        <x-slot name="content">
            @foreach ($datas as $key => $item)
                {{$key}} => {{$item}}
            @endforeach

            <div class="grid grid-cols-3 divide-x divide-gray-500">
                <div class="flex flex-col items-center">
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>code</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            
                            <x-forms.text wire:model="datas.code">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>title</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.title">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>

                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>filter</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.filter">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>filter_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.filter_pos">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.list">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.list_pos">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list_sort</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.list_sort">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>edit</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.edit">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
                </div>
                <div class="flex flex-col items-center">
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_pos">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_type</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_type">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_palceholder</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_placeholder">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_value</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_value">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_option</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_option">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_ref_table</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_ref_table">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_ref_field</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.form_ref_field">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    
                </div>
                <div class="flex flex-col items-center">
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>ref_table</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.ref_table">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>ref_field</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.ref_field">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>

                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>description</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text wire:model="datas.description">
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
                    
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                {{ __('확인') }}
            </x-jet-danger-button>
        </x-slot>

    </x-jinyui::modal-form>
</div>
