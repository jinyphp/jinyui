<x-card>
    <x-jet-button wire:click="createShowModal">추가</x-jet-button>

    <form>

        <x-forms.inline>
            <x-slot name="label">
                <x-forms.label>활성화</x-forms.label>
            </x-slot>
            <x-slot name="item">
                <x-forms.checkbox checked="checked">
                </x-forms.checkbox>
            </x-slot>
            <x-slot name="description">
                설명...
            </x-slot>
        </x-forms.inline>


        <x-forms.inline>
            <x-slot name="label">
                <x-forms.label>국가코드</x-forms.label>
            </x-slot>
            <x-slot name="item">
                <x-forms.text>abcd</x-forms.text>
            </x-slot>
            <x-slot name="description">
                설명...
            </x-slot>
        </x-forms.inline>


        <x-forms.inline>
            <x-slot name="label">
                <x-forms.label>국가명</x-forms.label>
            </x-slot>
            <x-slot name="item">
                <x-forms.text>abcd</x-forms.text>
            </x-slot>
            <x-slot name="description">
                설명...
            </x-slot>
        </x-forms.inline>


        <x-forms.inline>
            <x-slot name="item">
                <x-button class="btn btn-primary">
                    save
                </x-button>

                <x-button-outline>Reset</x-button-outline>
            </x-slot>
        </x-forms.inline>
        
    </form>

    {{$code}}

    {{-- 모달창 --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('국가 추가') }}
        </x-slot>

        <x-slot name="content">
            {{ __('새로운 국가를 추가합니다.') }}

            <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <x-jet-input type="password" class="mt-1 block w-3/4"
                            placeholder="{{ __('Password') }}"
                            x-ref="password"
                            wire:model.defer="password"
                            wire:keydown.enter="deleteUser" />

                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('등록') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</x-card>
