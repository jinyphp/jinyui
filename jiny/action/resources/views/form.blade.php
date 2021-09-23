<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container-fluid>
            <!-- content -->
            <x-row>
                <x-col>
                    <x-card>
                        <x-card-body>                            
                            @livewire('LiveForms',
                                ['rules'=>$rules])                                
                        </x-card-body>
                    </x-card>
                </x-col>
            </x-row>
            <!-- end of content -->
        </x-container-fluid>
	</x-main-content>
</x-theme>
