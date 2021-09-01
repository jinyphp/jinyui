<div>
    <x-modal-header>
        <h5 class="modal-title">회원추가</h5>
    </x-modal-header>
    <x-modal-body>
        @include("jinymem::members.member-edit")
    </x-modal-body>
    <x-modal-footer>
        <x-button secondary data-bs-dismiss="modal">
            취소
        </x-button>
        <x-button primary data-bs-dismiss="modal" 
            wire:click="store">
            확인
        </x-button>
    </x-modal-footer>
</div>