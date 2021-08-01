<div class="menutree">
    <div class="before">
        {!!$before!!}
    </div>
    <div class="body">
        {!! $tree !!}
    </div>
    <div class="after">
        {!!$after!!}
    </div>

    <x-button primary wire:click="sort">Sort</x-button>

    
    
    


    
    {{-- 모달창 --}}
    <x-jet-dialog-modal wire:model="modalEditMenuAdmin">
        <x-slot name="title">
            메뉴수정
        </x-slot>

        <x-slot name="content">
            <x-form-hor>
                <x-form-label>메뉴명</x-form-label>
                <x-form-item><input type="text" wire:model="_data.title"></x-form-item>
            </x-form-hor>
            
        </x-slot>

        <x-slot name="footer">
            {{--
            <x-button-outline wire:click="$toggle('modalEditMenuAdmin')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
            --}}
        </x-slot>
    </x-modal-form>
</div>


