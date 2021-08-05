
<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">펼침메뉴(Dropdown)</h1>

        <x-card>
            <x-card-body>
                Dropdown은 collapse 기능을 좀더 응용하여 여러개의 데이터를 묽어서 접어다 펼 수 있는 ui 화면 구현 기술입니다.
            </x-card-body>
        </x-card>


        

        <x-row>
            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">단일버튼 펼침메뉴</h5>
                        <h6 class="card-subtitle text-muted">버튼을 이용하여 몊침메뉴를 제어합니다.</h6>
                    </x-card-header>
                    <x-card-body class="flex flex-row gap-2">
                        <!-- Bootstrap 원본코드-->
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" 
                                type="button" id="dropdownMenuButton1" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Primary
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>

                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown secondary>Secondary</x-button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </x-dropdown>
                        
                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown success>Success</x-button>                            
                            <x-dropdown-menu aria-labelledby="dropdownMenuButton3">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </x-dropdown-menu>
                        </x-dropdown>

                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown info>Info</x-button>                            
                            <x-dropdown-menu aria-labelledby="dropdownMenuButton4">
                                <x-dropdown-item href="#">Action</x-dropdown-item>
                                <x-dropdown-item href="#">Another action</x-dropdown-item>
                                <x-dropdown-item href="#">Something else here</x-dropdown-item>
                            </x-dropdown-menu>
                        </x-dropdown>

                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown warning>Warning</x-button>                            
                            <x-dropdown-menu aria-labelledby="dropdownMenuButton5">
                                <x-slot name="json">
                                    [{"href":"#","title":"링크1"},{"href":"#","title":"링크2"},{"href":"#","title":"링크3"}]
                                </x-slot>                               
                            </x-dropdown-menu>
                        </x-dropdown>

                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown danger>Danger</x-button>                            
                            <x-dropdown-menu aria-labelledby="dropdownMenuButton6">
                                <x-slot name="json">
                                    [{"href":"#","title":"링크1"},{"href":"#","title":"링크2"},{"href":"#","title":"링크3"}]
                                </x-slot>
                                <x-dropdown-item href="#">Action</x-dropdown-item>
                                <x-dropdown-item href="#">Another action</x-dropdown-item>
                                <x-dropdown-item href="#">Something else here</x-dropdown-item>                            
                            </x-dropdown-menu>
                        </x-dropdown>
                        
                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">링크 펼침메뉴</h5>
                        <h6 class="card-subtitle text-muted">a링크를 이용하여 몊침메뉴를 제어합니다.</h6>
                    </x-card-header>
                    <x-card-body class="flex flex-row gap-2">
                        
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link1
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>

                        <x-dropdown>
                            <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link2
                            </a>                            
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </x-dropdown>

                        <x-dropdown>
                            <x-dropdown-link href="#">Dropdown link3</x-dropdown-link>                           
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </x-dropdown>

                        <x-dropdown>
                            <x-dropdown-link href="#">Dropdown link4</x-dropdown-link>
                            <x-dropdown-menu>
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </x-dropdown-menu>
                        </x-dropdown>

                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">버튼 그룹 펼침기능</h5>
                        <h6 class="card-subtitle text-muted">a링크를 이용하여 몊침메뉴를 제어합니다.</h6>
                    </x-card-header>
                    <x-card-body class="flex flex-row gap-2">

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <x-button-group>
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>                        
                        <h5 class="card-title">Split button</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </x-card-header>
                    <x-card-body class="flex flex-row gap-2">
                        
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </div>

                        <x-button-group>
                            <x-button secondary>Action</x-button>
                            <x-button success dropdown class="dropdown-toggle-split">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </x-button>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">Sizing</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                        
                    </x-card-header>
                    <x-card-body class="flex flex-row gap-2">
                        <x-button-group>
                            <x-button info dropdown small>Small button</x-button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                        <x-button-group>
                            <x-button warning dropdown large>Large button</x-button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                        


                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>                        
                        <h5 class="card-title">Dark dropdowns</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </x-card-header>
                    <x-card-body>
                        <!-- Jinyui 테그-->
                        <x-dropdown>
                            <x-button dropdown secondary>Dark dropdowns</x-button>                            
                            <x-dropdown-menu class="dropdown-menu-dark">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </x-dropdown-menu>
                        </x-dropdown>

                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>                        
                        <h5 class="card-title">nav</h5>
                        <h6 class="card-subtitle text-muted">네비게이션 바에서도 펼침메뉴를 같이 사용할 수 있습니다.</h6>
                    </x-card-header>
                    <x-card-body>
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#">Navbar</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                    
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                    <ul class="navbar-nav">

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark" >
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <x-dropdown-link class="nav-link" href="#">link</x-dropdown-link>
                                            <x-dropdown-menu class="dropdown-menu-dark">
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </x-dropdown-menu>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </x-card-body>
                </x-card>
            </x-col-6>


            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">direction UP</h5>
                        <h6 class="card-subtitle text-muted">.</h6>
                    </x-card-header>
                    <x-card-body>
                        <x-button-group>
                            <x-button primary dropdown>Action</x-button>
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                        <x-button-group class="dropup">
                            <x-button secondary dropdown>Action</x-button>
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                        <x-button-group class="dropstart">
                            <x-button success dropdown>Action</x-button>
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                        <x-button-group class="dropend">
                            <x-button danger dropdown>Action</x-button>
                            
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                        </x-button-group>

                    </x-card-body>
                </x-card>
            </x-col-6>

            <x-col-6>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Dropdowns</h5>
                        <h6 class="card-subtitle text-muted">Toggle contextual overlays for displaying lists of links.</h6>
                    </div>
                    <div class="card-body pb-0">

                        <div class="row mb-3">
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Basic:</p>
                                <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Active:</p>
                                <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                    <a class="dropdown-item" href="#">Regular link</a>
                                    <a class="dropdown-item active" href="#">Active link</a>
                                    <a class="dropdown-item" href="#">Another link</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Disabled:</p>
                                <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                    <a class="dropdown-item" href="#">Regular link</a>
                                    <a class="dropdown-item disabled" href="#">Disabled link</a>
                                    <a class="dropdown-item" href="#">Another link</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Header:</p>
                                <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                    <h6 class="dropdown-header">Dropdown header</h6>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Dividers:</p>
                                <div class="dropdown-menu mb-2" style="position:static;display:block;">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xl-6 col-xxl-4">
                                <p class="mb-0">Text:</p>
                                <div class="dropdown-menu p-4 text-muted" style="max-width: 200px;position:static;display:block;">
                                    <p class="mb-0">
                                        Some example text that's free-flowing within the dropdown menu.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </x-col-6>


        </x-row>

    </div>

</x-jinyui-theme>
