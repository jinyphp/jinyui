{{-- 테마 사이드바--}}

<x-jinyui-sidebar-content>

    <x-jinyui-sidebar-logo>
        <a href="index.html">
            <span class="logo-text align-middle">
                @if (isset($logo))
                    {{$logo}}
                @else                
                    JinyUI-Kit
                @endif
                
            </span>
        </a>
    </x-jinyui-sidebar-logo>

    <x-jinyui-sidebar-nav>

            <x-jinyui-sidebar-header>
                Pages
            </x-jinyui-sidebar-header>
    
            <li class="sidebar-item active">
    
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <x-jinyui-icon name="sliders"/>
                    <span class="align-middle">Dashboards</span>
                </a>
    
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" >
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="index.html">Analytics</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/dashboard/ecommerce.html">E-Commerce <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/dashboard/crypto.html">Crypto <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                </ul>
            </li>
    
            <li class="sidebar-item">
    
                <a class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" >
                    
                    <x-jinyui-icon name="layout"/>
                    <span class="align-middle">Pages</span>
                </a>
    
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/settings">Settings</a></li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/projects">Projects <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/clients">Clients <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/pricing">Pricing <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/chat">Chat <span class="sidebar-badge badge bg-primary">Pro</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/jinyui/pages/page/blank">Blank Page</a></li>
                </ul>
            </li>
    
            <li class="sidebar-item">
                <a class="sidebar-link" href="/jinyui/pages/profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span class="align-middle">Profile</span>
                </a>
            </li>
    
            <li class="sidebar-item">
                <a class="sidebar-link" href="/jinyui/pages/invoice">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card align-middle"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg> <span class="align-middle">Invoice</span>
                </a>
            </li>
    
            <li class="sidebar-item">
                <a class="sidebar-link" href="/jinyui/pages/tasks">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list align-middle"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg> <span class="align-middle">Tasks</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>
    
            <li class="sidebar-item">
                <a class="sidebar-link" href="/jinyui/calendar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> <span class="align-middle">Calendar</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>
    
            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="users"/>
                    <span class="align-middle">Auth</span>
                
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/auth/signin">Sign In</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/auth/signup">Sign Up</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/auth/password">Reset Password <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/auth/404">404 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/auth/500">500 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
    
            <x-jinyui-sidebar-header>
                Components
            </x-jinyui-sidebar-header>
    
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="briefcase"/>
                    <span class="align-middle">UI Elements</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/alerts">Alerts</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/buttons">Buttons</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/cards">Cards</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/general">General</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/grid">Grid</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/modals">Modals</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/offcanvas">Offcanvas <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/tabs">Tabs <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/ui/typography">Typography</a></li>
                </ul>
            </li>
    
            <li class="sidebar-item">
                <a data-bs-target="#icons" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="coffee"/>
                    <span class="align-middle">Icons</span>
                    <x-jinyui-sidebar-badge class="bg-light">1.500+</x-jinyui-sidebar-badge>            
                </a>
                <ul id="icons" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="icons-feather.html">Feather</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="icons-font-awesome.html">Font Awesome <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
    
            <li class="sidebar-item">
                <a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="check-circle"/>
                    <span class="align-middle">Forms</span>
                </a>
                <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/forms/basic">Basic Inputs</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/forms/layouts">Form Layouts <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="/jinyui/forms/groups">Input Groups <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
    
    
            {{-- 테이블 --}}    
            <x-jinyui-sidebar-submenu>
                <x-slot name="hello">aaa</x-slot>
                <x-slot name="title"> 
                    <x-jinyui-icon name="list"/>
                    <span class="align-middle">Tables</span>
                </x-slot>
    
                <!-- collapse content-->
                <x-jinyui-sidebar-submenu>
                    <x-slot name="title"> 
                        <span class="align-middle">Table</span>
                    </x-slot>
    
                    <!-- collapse content-->
                    <x-jinyui-sidebar-item >
                        <x-jinyui-sidebar-link href="/jinyui/tables/table">
                            Table
                        </x-jinyui-sidebar-link>
                    </x-jinyui-sidebar-item>
                </x-jinyui-sidebar-submenu>
    
                <x-jinyui-sidebar-item>
                    <a class="sidebar-link" href="/jinyui/tables/data">Data</a>
                </x-jinyui-sidebar-item>
    
            </x-jinyui-sidebar-submenu>
    
    
            <x-jinyui-sidebar-header>
                Plugins &amp; Addons
            </x-jinyui-sidebar-header>
    
            <li class="sidebar-item">
                <a data-bs-target="#form-plugins" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="check-square"/>
                    <span class="align-middle">Form Plugins</span>            
                </a>
                <ul id="form-plugins" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="forms-advanced-inputs.html">Advanced Inputs <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="forms-editors.html">Editors <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="forms-validation.html">Validation <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="list"/>
                    <span class="align-middle">DataTables</span>
                </a>
                <ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-responsive.html">Responsive Table <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-buttons.html">Table with Buttons <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-column-search.html">Column Search <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-fixed-header.html">Fixed Header <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-multi.html">Multi Selection <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="tables-datatables-ajax.html">Ajax Sourced Data <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#charts" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="bar-chart-2"/>
                    <span class="align-middle">Charts</span>
                
                </a>
                <ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="charts-chartjs.html">Chart.js</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="charts-apexcharts.html">ApexCharts <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="notifications.html">
                    
                    <x-jinyui-icon name="bell"/>
                    <span class="align-middle">Notifications</span>
                    
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#maps" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <x-jinyui-icon name="map"/>
                    <span class="align-middle">Maps</span>
                    
                </a>
                <ul id="maps" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="maps-google.html">Google Maps</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="maps-vector.html">Vector Maps <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
    
            <li class="sidebar-item">
                <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed">
                   <x-jinyui-icon name="corner-right-down"/>
                    <span class="align-middle">Multi Level</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed">Two Levels</a>
                        <ul id="multi-2" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Item 1</a>
                                <a class="sidebar-link" href="#">Item 2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-3" data-bs-toggle="collapse" class="sidebar-link collapsed">Three Levels</a>
                        <ul id="multi-3" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a data-bs-target="#multi-3-1" data-bs-toggle="collapse" class="sidebar-link collapsed">Item 1</a>
                                <ul id="multi-3-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 1</a>
                                        <a class="sidebar-link" href="#">Item 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Item 2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
    </x-jinyui-sidebar-nav>
    

    <div class="sidebar-cta">
        <div class="sidebar-cta-content">
            <strong class="d-inline-block mb-2">Weekly Sales Report</strong>
            <div class="mb-3 text-sm">
                Your weekly sales report is ready for download!
            </div>

            <div class="d-grid">
                <a href="https://adminkit.io/" class="btn btn-outline-primary" target="_blank">Download</a>
            </div>
        </div>
    </div>

</x-jinyui-sidebar-content>
