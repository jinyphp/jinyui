<x-form-hor>
    <x-form-label></x-form-label>
    <x-form-item>
        @if (isset($rules['edit_id']))
            <x-modal-button danger data-bs-target="#delete-id-popup">
                삭제(F4)
            </x-modal-button>
            <x-modal-layout small id="delete-id-popup">
                <x-modal-header>
                    <h5 class="modal-title">확인</h5>
                </x-modal-header>
                <x-modal-body>
                    항목을 삭제합니다.
                </x-modal-body>
                <x-modal-footer>
                    <x-button secondary data-bs-dismiss="modal">
                        취소
                    </x-button>
                    <x-button danger data-bs-dismiss="modal" id="btn-delete" 
                        wire:click="delete">
                        확인
                    </x-button>
                </x-modal-footer>
            </x-modal-layout>

            <x-button info wire:click="update">수정(F3)</x-button>
        @else
            <x-button info outline wire:click="storeReset">취소</x-button>
            <x-button primary wire:click="store">등록(F2)</x-button>
        @endif
    </x-form-item>
</x-form-hor>