<x-form>
    <x-form-row>
        <x-form-label>활성화</x-form-label>
        <x-form-item>
            <x-checkbox name="enable" wire:model="_data.enable"/>
            <span class="form-text">Action Route를 활성화 합니다.</span>
        </x-form-item>
    </x-form-hor>

    <x-row>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>타이틀</x-form-label>
                <x-form-item>
                    <x-input type="text" name="title" wire:model="_data.title"></x-input>
                    <div class="form-text">.</div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-8">
            <x-form-row>
                <x-form-label>서브타이틀</x-form-label>
                <x-form-item>
                    {!! 
                        xTextarea("subtitle")
                        ->setAttribute('wire:model.deafer',"_data.subtitle")
                    !!}
                    <div class="form-text">.</div>
                </x-form-item>
            </x-form-row>
        </x-col>
    </x-row>       

    <br>
    <x-row>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>Method : </x-form-label>
                <x-form-item>
                    <x-select name="method" wire:model="_data.method">
                        <x-option value="resource">Resource</x-option>
                        <x-option value="get">Get</x-option>
                        <x-option value="post">Post</x-option>
                        <x-option value="put">Put</x-option>
                        <x-option value="delete">Delete</x-option>
                    </x-select>
                    
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>prefix</x-form-label>
                <x-form-item>
                    <x-input type="text" name="prefix" wire:model="_data.prefix"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>Nested</x-form-label>
                <x-form-item>
                    <x-input type="text" name="tablename" wire:model="_data.nested"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4">
            <x-form-row>
                <x-form-label>Route Uri</x-form-label>
                <x-form-item>
                    <x-input type="text" name="uri" wire:model="_data.uri"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>Role</x-form-label>
                <x-form-item>
                    <x-input type="text" name="type" wire:model="_data.role"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
    </x-row>

    <br>
    <x-row>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>Class</x-form-label>
                <x-form-item>
                    <x-input type="text" name="class" wire:model="_data.class"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>List View</x-form-label>
                <x-form-item>
                    <x-input type="text" name="tablename" wire:model="_data.list_view"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>List SubView</x-form-label>
                <x-form-item>
                    
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        
            
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4">
            <x-form-row>
                <x-form-label>Edit View</x-form-label>
                <x-form-item>
                    <x-input type="text" name="tablename" wire:model="_data.edit_view"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>

            <x-form-row>
                <x-form-label>Edit SubView</x-form-label>
                <x-form-item>
                    
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
    </x-row>

    <br>
    <x-row>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>Type</x-form-label>
                <x-form-item>
                    <x-select name="type" wire:model="_data.type">
                        <x-option value="table">Table</x-option>
                        <x-option value="form">Form</x-option>
                        <x-option value="page">Page</x-option>
                    </x-select>
                    
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4 border-r">
            <x-form-row>
                <x-form-label>Tablename</x-form-label>
                <x-form-item>
                    <x-input type="text" name="tablename" wire:model="_data.tablename"></x-input>
                    <div class="form-text"><div class=""></div></div>
                </x-form-item>
            </x-form-row>
        </x-col>
        <x-col class="col-12 col-md-6 col-lg-4 ">
        </x-col>
    </x-row>



    <x-form-row>
        <x-form-label>description</x-form-label>
        <x-form-item>
            {!! 
                xTextarea("description")
                ->setAttribute('wire:model.deafer',"_data.description")
            !!}

            <div class="form-text"><div class=""></div></div>
        </x-form-item>
    </x-form-row>

    @if (isset($rules['edit_id']))
        <x-button info wire:click="update">수정(F3)</x-button>
    @else
        <x-button primary wire:click="store">등록(F2)</x-button>
    @endif


</x-form>