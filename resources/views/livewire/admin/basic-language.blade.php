<x-content class="p-3">
    

    {{-- 필터박스 --}}
    <div class="flex flex-row justify-center bg-white p-4 border">
        <div class="container max-w-screen-sm">
            
            <x-forms.row>
                <x-forms.item-end class="w-1/3">
                    <x-forms.label >국가코드</x-forms.label>
                </x-forms.item>
                <x-forms.item class="w-2/3">
                    <x-forms.text >국가코드</x-forms.text>
                </x-forms.item> 
            </x-forms.row>

            <x-forms.row class="border-t pt-2">
                <x-button class="btn-blue mr-2">
                    {{ __('검색(F3)') }}
                </x-button>
                <x-button-outline >
                    {{ __('초기화(F5)') }}
                </x-button-outline>
            </x-forms.row>
        </div>
    </div>





    {{-- 목록 --}}
    <div class="border bg-white p-4 mt-2">
        <x-table></x-table>
        
        <x-flex-row class="py-4">
            <x-item class="w-1/5">선택</x-item>
            <x-item-center class="w-3/5">페이지</x-item-center>
            <x-item-end class="w-1/5">
                <x-button class="mr-1 btn-blue" wire:click="createShowModal">추가(F2)</x-button>
            </x-item-end>
        </x-flex-row>
    </div>
    <div class="py-2">
        <x-button-outline class="mr-1 btn-gray" wire:click="csvExport">엑셀(F7)</x-button>
        <x-button-outline class="mr-1 btn-gray" wire:click="csvImport">가져오기(F8)</x-button>
        <x-button-outline class="mr-1 btn-gray" wire:click="printOutput">인쇄(F9)</x-button>
        <x-button-outline class="mr-1 btn-gray" wire:click="pdfOutput">PDF(F10)</x-button>
    </div>


    
{{-- 모달창 --}}
<x-modal-form wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('국가 관리') }}
    </x-slot>

    <x-slot name="content">

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
            
        

    </x-slot>

    <x-slot name="footer">
        <x-button-outline wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-button class="ml-2 btn-blue" wire:click="create" wire:loading.attr="disabled">
            {{ __('등록') }}
        </x-jet-danger-button>
    </x-slot>
</x-modal-form>
    
</x-content>
