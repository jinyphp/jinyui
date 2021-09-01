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



    {{--
    @if ($admin == true)
        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <x-button wire:click="sort">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </x-button>

            </div>
        </div>
    @endif
    --}}


    
    {{-- 모달창 --}}
    {{--
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
           
            <x-button-outline wire:click="$toggle('modalEditMenuAdmin')" wire:loading.attr="disabled">
                {{ __('취소') }}
            </x-jet-secondary-button>

            <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                {{ __('수정') }}
            </x-jet-danger-button>
        
        </x-slot>
    </x-modal-form>
    --}}
</div>


