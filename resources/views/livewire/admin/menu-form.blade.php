<div>
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


    <x-forms.inline>
        <x-slot name="label">
            <x-forms.label>메뉴코드</x-forms.label>
        </x-slot>
        <x-slot name="item">
            <x-forms.text wire:model="_code"></x-forms.text>
        </x-slot>
        <x-slot name="description">
            설명...
        </x-slot>
    </x-forms.inline>

    <x-forms.inline>
        <x-slot name="label">
            <x-forms.label>Url</x-forms.label>
        </x-slot>
        <x-slot name="item">
            <x-forms.text wire:model="_uri"></x-forms.text>
        </x-slot>
        <x-slot name="description">
            설명...
        </x-slot>
    </x-forms.inline>

    <x-forms.inline>
        <x-slot name="label">
            <x-forms.label>메뉴명</x-forms.label>
        </x-slot>
        <x-slot name="item">
            <x-forms.text wire:model="_title"></x-forms.text>
        </x-slot>
        <x-slot name="description">
            설명...
        </x-slot>
    </x-forms.inline>

    <x-forms.inline>
        <x-slot name="label">
            <x-forms.label>terget</x-forms.label>
        </x-slot>
        <x-slot name="item">
            <x-forms.text wire:model="_target"></x-forms.text>
        </x-slot>
        <x-slot name="description">
            설명...
        </x-slot>
    </x-forms.inline>

    <x-forms.inline>
        <x-slot name="label">
            <x-forms.label>설명</x-forms.label>
        </x-slot>
        <x-slot name="item">
            <x-forms.text wire:model="_description"></x-forms.text>
        </x-slot>
        <x-slot name="description">
            설명...
        </x-slot>
    </x-forms.inline>
</div>
