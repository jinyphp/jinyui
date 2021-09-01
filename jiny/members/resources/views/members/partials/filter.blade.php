<!-- 검색필터 -->
	
        <x-card>
            <x-card-body>
                
                <div class="w-2/4 mx-auto">
                    <x-flex-center class="gap-1">
                        <div class="flex-grow">
                            <x-form-hor>
                                <x-form-label>
                                    출력목록
                                </x-form-label>
                                <x-form-item>
                                    {!! xInputText('listnum')->setWidth("small")->setAttribute("wire:model.defer","_filter.listnum") !!}
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>
                                    성별
                                </x-form-label>
                                <x-form-item>
                                    {!! xRadioGroup()
                                        ->addRadio(
                                            xRadio("sex", "man")->setAttribute("wire:model.defer","_filter.sex"), 
                                            "남성")
                                        ->addRadio(
                                            xRadio("sex", "woman")->setAttribute("wire:model.defer","_filter.sex"), 
                                            "여성")
                                        ->addRadio(
                                            xRadio("sex", "company")->setAttribute("wire:model.defer","_filter.sex"), 
                                            "법인")
                                        ->setInline()
                                        
                                    !!}
                                </x-form-item>
                            </x-form-hor>
                        </div>
                        <div class="flex-grow">
                            <x-form-hor>
                                <x-form-label>
                                    국가
                                </x-form-label>
                                <x-form-item>
                                    {!! xInputText('country')->setWidth("small")->setAttribute("wire:model.defer","_filter.country") !!}
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>
                                    이메일
                                </x-form-label>
                                <x-form-item>
                                    {!! xInputText('email')->setWidth("standard")->setAttribute("wire:model.defer","_filter.email") !!}
                                </x-form-item>
                            </x-form-hor>
                        </div>						
                    </x-flex-center>

                    <hr>

                    <x-flex-center class="gap-1">
                        <x-button info outline wire:click="search_reset">취소(F4)</x-button>
                        <x-button primary wire:click="search">검색(F5)</x-button>
                    </x-flex-center>
                </div>

            </x-card-body>						
        </x-card>				
