<x-form>
    {!! $ActionForms->build() !!}



    @if (isset($rules['edit_id']))
        <x-button info wire:click="update">수정(F3)</x-button>
    @else
        <x-button primary wire:click="store">등록(F2)</x-button>
    @endif


</x-form>