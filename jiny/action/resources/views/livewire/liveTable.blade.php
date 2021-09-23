<div>
    {{-- LiveAction으로 설정한 데이터를 테이블로 출력합니다. --}}
    {!! $ActionTable->build("table-bordered") !!}


    <x-button info wire:click="setAddListField">필드추가</x-button>


    {{-- admin --}}
    <x-jet-dialog-modal wire:model="editListField">
        <x-slot name="title">
            {{ __('필드정보 수정') }}
        </x-slot>

        <x-slot name="content">
            @include('jinyaction::fields.form_fields')
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('editListField')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="changeListField" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


    <x-jet-dialog-modal wire:model="addListField">
        <x-slot name="title">
            {{ __('필드정보 수정') }}
        </x-slot>

        <x-slot name="content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 20px;"></th>
                        <th>ID</th>
                        <th>타이틀</th>
                        <th>설명</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($_fields as $key => $item)
                    <tr>
                        <td style="width: 20px;">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                    wire:model="_fields.{{$key}}.list" >                                
                                <label for="ids_2" class="form-check-label">&nbsp;</label>
                            </div>
                        </td>

                        <td>
                            {{$item['id']}}
                        </td>
                        <td>{{$item['title']}}</td>
                        <td>{{$item['description']}}</td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('addListField')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="ListFieldAdd" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    
</div>

