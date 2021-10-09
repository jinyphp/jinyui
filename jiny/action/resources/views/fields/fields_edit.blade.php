<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container-fluid>
                
            {{ currentRouteName() }}
                
            <!-- contents -->
            <x-row>
                <x-col>
                    <x-card>
                        <x-card-body>
                           
                            @livewire('LiveFieldCreate',
                                ['rules'=>$rules])
                        </x-card-body>
                    </x-card>
                </x-col>
            </x-row>
            <!-- end of contents -->

        </x-container-fluid>
	</x-main-content>
</x-theme>
