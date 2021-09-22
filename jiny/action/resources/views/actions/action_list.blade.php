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
                        액션등록
                        </x-link>
            
                    </div>
                </div>
            </div>

            <x-row>
                <x-col>
                    <x-card>
                        <x-card-body>

                            @livewire('LiveAction',
                                [
                                    'viewfile'=>"jinyaction::livewire.liveAction",
                                    'rules'=>$rules
                                ])
                        </x-card-body>
                    </x-card>
                </x-col>
            </x-row>


            

        </x-container>
	</x-main-content>
</x-theme>