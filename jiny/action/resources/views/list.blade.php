<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container-fluid>
            <!-- start page title -->
            <x-row >
                <x-col class="col-8">
                    <div class="page-title-box">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                            <li class="breadcrumb-item active">Business</li>
                        </ol>                        
                    
                        <div class="mb-3">
                            @if (isset($rules['title']))
                                <h1 class="h3 d-inline align-middle">{{$rules['title']}}</h1>
                            @endif

                            @if (isset($rules['subtitle']))
                                <p>{{$rules['subtitle']}}</p>
                            @endif
                        </div>
                    </div>
                </x-col>
            </x-row>  
            <!-- end page title -->

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
                            @livewire('LiveTable',
                                [
                                    'viewfile'=>"jinyaction::livewire.liveTable",
                                    'rules'=>$rules
                                ])
                        </x-card-body>
                    </x-card>
                </x-col>
            </x-row>

        </x-container>
	</x-main-content>
</x-theme>