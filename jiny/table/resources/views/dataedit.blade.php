<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>
            
            {{-- 삽입/수정/삭제 --}}
            @livewire('tabledata-edit',['rules'=>$rules])

        </x-container>
    </x-main-content>
</x-theme>
