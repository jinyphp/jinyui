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

            <x-row>
                <x-col-12>
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Settings</h4>
                    </div>
                </x-col-12>
                <x-col-12>
                    <p>list와 tab을 이용하여 다양한 사용자 정보를 입력받을 수 있는 설정화면을 구현할 수 있습니다.</p>
                </x-col-12>
            </x-row>

            <!-- Content -->

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