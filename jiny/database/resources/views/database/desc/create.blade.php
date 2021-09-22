<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>
                        	<li class="breadcrumb-item active">Tables</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">{{$table}} 필드생성</h1>
                            <p>
                            
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			<div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>
                        <a href="#" class="btn btn-primary">목록</a>
                    </div>
                </div>
            </div>

            <x-row>
                <x-col-12>
                    <x-card>
                        <form action="{{route('admin-db-desc.store', "action_field")}}" method="post">
                            @csrf
                            <input type="hidden" name="table" value="{{$table}}">

                            <x-form-hor>
                                <x-form-label>필드명</x-form-label>
                                <x-form-item>
                                    <x-input type="text" name="field_name" width="standard" />
                                
                                </x-form-item>
                            </x-form-hor>


                            <x-form-hor>
                                <x-form-label>타입</x-form-label>
                                <x-form-item>

                                    <x-select name="field_type" width="standard">
                                        <x-option value="string">String</x-option>
                                        <x-option value="integer">Integer</x-option>
                                        <x-option value="bigInteger">BigInteger</x-option>
                                    </x-select>

                                </x-form-item>
                            </x-form-hor>

                            
                            <x-form-hor>
                                <x-form-label>Null</x-form-label>
                                <x-form-item>
                                    <x-checkbox name="field_nul"></x-checkbox>
                                    
                                </x-form-item>
                            </x-form-hor>


                            <x-form-hor>
                                <x-form-label>Key</x-form-label>
                                <x-form-item>
                                    <x-input type="text" name="field_key" width="standard" />
                                </x-form-item>
                            </x-form-hor>


                            <x-form-hor>
                                <x-form-label>Default</x-form-label>
                                <x-form-item>
                                    <x-input type="text" name="field_default" width="standard" /> 
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label></x-form-label>
                                <x-form-item>
                                    <x-button type="submit" primary>추가</x-button>
                                </x-form-item>
                            </x-form-hor>                         


                        </form>
                    </x-card>
                </x-col-12>
            </x-row>
            
		</x-container>
	</x-main-content>
</x-theme>

