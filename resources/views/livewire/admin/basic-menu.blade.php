<x-content class="p-3">
    {{-- 타이틀 및 제어버튼 --}}
    <x-slot name="title"> 메뉴관리</x-slot>
    <x-slot name="control">
        <x-button class="mr-3 btn-blue" wire:click="create">추가(F3)</x-button>
        <x-button class="mr-3 btn-blue" id="btn-delete" disabled wire:click="delete">삭제(F4)</x-button>
        <x-button class="mr-3 btn-blue" wire:click="csvExport">엑셀(F7)</x-button>
        <x-button class="mr-3 btn-blue" wire:click="csvImport">가져오기(F8)</x-button>
        <x-button class="mr-3 btn-blue" wire:click="printOutput">인쇄(F9)</x-button>
        <x-button class="mr-3 btn-blue" wire:click="pdfOutput">PDF(F10)</x-button>
    </x-slot>



    {{-- 조건검색 필터 --}}
    <x-filter-box class="mb-2">
        <x-forms.row>
            <x-forms.item-end class="w-1/3">
                <x-forms.label>메뉴코드</x-forms.label>
            </x-forms.item-end>
            <x-forms.item class="w-2/3">
                <x-forms.text>메뉴코드</x-forms.text>
            </x-forms.item>
        </x-forms.row>

        <x-forms.row>
            <x-forms.item-end class="w-1/3">
                <x-forms.label>메뉴명</x-forms.label>
            </x-forms.item-end>
            <x-forms.item class="w-2/3">
                <x-forms.text></x-forms.text>
            </x-forms.item>
        </x-forms.row>

        <div class="border-t pt-2 flex flex-row justify-center">
            <div class="mr-1">
                <x-button class="btn-blue">{{ __('필터조건(F3)') }}</x-button>
            </div>
            <div class="ml-1">
                <x-button class="btn-alt-blue">{{ __('초기화(F5)') }}</x-button>
            </div>
        </div>
    </x-filter-box>


    <x-button class="mr-3 btn-blue" wire:click="create">추가(F3)</x-button>


    {{-- 데이터 목록 --}}
    <x-table :data="$data" class="mt-2">
    </x-table>

    <div class="py-2">
        <x-button class="mr-1 btn-outline-gray" wire:click="csvExport">엑셀(F7)</x-button>
        <x-button class="mr-1 btn-outline-gray" wire:click="csvImport">가져오기(F8)</x-button>
        <x-button class="mr-1 btn-outline-gray" wire:click="printOutput">인쇄(F9)</x-button>
        <x-button class="mr-1 btn-outline-gray" wire:click="pdfOutput">PDF(F10)</x-button>
    </div>



    {{-- 모달창 --}}
    <x-modal-form wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __($title) }}
            @if ($mode == "new")
            추가
            @endif
        </x-slot>

        <x-slot name="content">

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

        </x-slot>

        <x-slot name="footer">

            @if ($mode == "new")
                <x-button-outline wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                    {{ __('취소') }}
                </x-jet-secondary-button>

            @else
                <x-button-outline wire:click="delete" wire:loading.attr="disabled">
                    {{ __('삭제') }}
                </x-jet-secondary-button>
            @endif

            @if ($_id)
                <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                    {{ __('수정') }}
                </x-jet-danger-button>
                
            @else
                <x-button class="ml-2 btn-blue" wire:click="insert" wire:loading.attr="disabled">
                    {{ __('등록') }}
                </x-jet-danger-button>
            @endif
                
        </x-slot>
    </x-modal-form>

</x-content>
