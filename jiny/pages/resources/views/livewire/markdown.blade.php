<div class="markdown">

    {!! $content !!}


    <x-jet-dialog-modal wire:model="popupTransEnable">
        <x-slot name="title">
            {{ __('문자열 번역') }}
        </x-slot>

        <x-slot name="content">
            {{$transText}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('popupTransEnable')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="trans" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
