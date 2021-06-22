<div>
    {{-- The whole world belongs to you. --}}
    <button class="btn btn-blue" wire:click="fieldList">설정</button>



    {{-- 모달창 --}}
    <x-jinyui::modal-form maxWidth="5xl" wire:model="modalEditVisible">

        <x-slot name="title">
            필드설정
        </x-slot>

        <x-slot name="content">
            <table>
                <tbody>
                    @foreach ($fields as $key => $item)
                        <tr>
                            <td>{{$item->code}}</td>
                            <td wire:click="fieldEdit">{{$item->title}}</td>
                            <td>{{$item->filter}}</td>
                            <td>{{$item->list}}</td>
                            <td>{{$item->edit}}</td>
                            <td>{{$item->form_type}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            <x-button class="ml-2 btn-blue" wire:click="FieldInsert" wire:loading.attr="disabled">
                {{ __('추가') }}
            </x-jet-danger-button>
                
        </x-slot>

        
    </x-modal-form>

    
    <x-jinyui::modal-list maxWidth="7xl" wire:model="modalFieldEditVisible">
        <x-slot name="title">
            필드수정
        </x-slot>
        <x-slot name="content">
            <div class="grid grid-cols-3 divide-x divide-gray-500">
                <div class="flex flex-col items-center">
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>code</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>title</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>

                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>filter</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>filter_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>list_sort</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>edit</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
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
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_pos</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_type</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_palceholder</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_value</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_option</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_ref_table</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>form_ref_field</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
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
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
        
                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>ref_field</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>

                    <x-forms.inline>
                        <x-slot name="label">
                            <x-forms.label>description</x-forms.label>
                        </x-slot>
                        <x-slot name="item">
                            <x-forms.text>
                            </x-forms.text>
                        </x-slot>
                    </x-forms.inline>
                    
                </div>
            </div>


        </x-slot>
        <x-slot name="footer">
            kdfjkalsdfkj
        </x-slot>

    </x-jinyui::modal-form>
</div>
