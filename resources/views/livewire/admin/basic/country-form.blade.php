<x-card>
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
</x-card>
