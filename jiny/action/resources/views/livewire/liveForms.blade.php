<x-form>

    {!! $ActionForms->build() !!}



    @if (isset($rules['edit_id']))
        <x-button danger wire:click="delete">삭제(F4)</x-button>
        <x-button info wire:click="update">수정(F3)</x-button>
    @else
        <x-button secondary wire:click="clear">초기화(F5)</x-button>
        <x-button primary wire:click="store">등록(F2)</x-button>
    @endif


    {{-- admin --}}
    <x-button warning wire:click="newField">필드추가</x-button>
    <x-jet-dialog-modal wire:model="openDialogField">
        <x-slot name="title">
            {{ __('필드정보') }}
        </x-slot>

        <x-slot name="content">
            abcd
            
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openDialogField')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="changeListField" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>


</x-form>