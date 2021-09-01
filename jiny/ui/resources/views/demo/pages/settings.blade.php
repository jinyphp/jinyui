<style>
.tab-content>.tab-pane {
    display: none
}

.tab-content>.active {
    display: block
}
</style>

<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                        	<li class="breadcrumb-item active">Settings</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Settings</h1>
                            <p>
                                list와 tab을 이용하여 다양한 사용자 정보를 입력받을 수 있는 설정화면을 구현할 수 있습니다.
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
                    </div>
                </div>
            </div>



            <x-row>
            
                <div class="col-12 col-md-3 col-xl-2">
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title mb-0">Profile Settings</h5>
                        </x-card-header>

                        <x-list-group-flush role="tablist">
                        
                            {{-- 
                            {{ BootTab()->links(
                                [
                                    'account'=>"Account", 
                                    'password'=>"password",
                                    '#1'=>"Privacy and safety",
                                    '#2'=>"Email notifications",
                                    '#3'=>"Web notifications",
                                    '#4'=>"Widgets",
                                    '#5'=>"Your data",
                                    '#6'=>"Delete account",
                                ],
                                "account") }}

                        
                            @foreach (BootTab()->popHeaders() as $item)
                                {!! $item !!}
                            @endforeach
                            --}}

                            <x-tab-header-json active="account">
                                {
                                    "account":"Account", 
                                    "password":"password",
                                    "#1":"Privacy and safety",
                                    "#2":"Email notifications",
                                    "#3":"Web notifications",
                                    "#4":"Widgets",
                                    "#5":"Your data",
                                    "#6":"Delete account"
                                }
                            </x-tab-header-json>

                        </x-list-group-flush>
                    </x-card>
                </div>




                <div class="col-12 col-md-9 col-xl-10">
                    {{--
                    <div class="tab-content">
                        <x-tab-item class="active show" id="account">
                            @include('jinyui::demo.pages.settings.tab-account')                            
                        </x-tab-item>

                        <x-tab-item id="password">                        
                            @include('jinyui::demo.pages.settings.tab-password')
                        </x-tab-item>

                        @foreach (BootTab()->popContents() as $item)
                            {!! $item !!}
                        @endforeach
                    </div>
                    --}}

                    <x-tab-contents>
                        <x-tab-item class="active show" id="account">
                            @include('jinyui::demo.pages.settings.tab-account')
                        </x-tab-item>
                        <x-tab-item id="password">
                            @include('jinyui::demo.pages.settings.tab-password')
                        </x-tab-item> 
                    </x-tab-contents> 
                    
                </div>
                


            </x-row>
        </x-container>
    </x-main-content>

</x-theme>   