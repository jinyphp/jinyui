<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container-fluid>

            <div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>

                        <x-link 
                            href="{{ $createLink }}" 
                            class="btn btn-primary">
                        필드추가
                        </x-link>
                    </div>
                </div>
            </div>

            <x-card>
                <x-card-body>
                    @livewire('LiveField',
                        [
                            'viewfile'=>"jinyaction::livewire.liveField",
                            'rules'=>$rules
                        ])
                </x-card-body>
            </x-card>

        </x-container-fluid>
	</x-main-content>
</x-theme>