{{-- 테마 사이드바--}}
<nav id="sidebar" class="sidebar js-sidebar">
    <x-simplebar class="sidebar-content">

        <a class="sidebar-brand" href="/sales">
            <span class="sidebar-brand-text align-middle">
                JinyERP
            </span>
        </a>

        <!-- 사이드바 메뉴 -->
        <x-menu>
            <x-sidebar-nav>
                <x-sidebar-header>Sales</x-sidebar-header>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">business</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/business">business</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/business/edit">business-edit</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>


                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">company</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-company">sales-company</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-company-edit">sales-company-edit</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-company-list">sales-company-list</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-company-sync">sales-company-sync</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-company-syncNew">sales-company-syncNew</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>
                

                

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Goods</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-goods">sales-goods</x-sidebar-link>
                        </x-sidebar-item>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-goods-edit">sales-goods-edit</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-goods-info">sales-goods-info</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-goods-list">sales-goods-list</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-goods-sync">sales-goods-sync</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Bom</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-bom">sales-bom</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-bom-edit">sales-bom-edit</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">House</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-house">sales-house</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-house-edit">sales-house-edit</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Manager</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-manager">sales-manager</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-manager-edit">sales-manager-edit</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Quotation</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-quotation">sales-quotation</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-quotation-company">sales-quotation-company</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-quotation-edit">sales-quotation-edit</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Report</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-report">sales-report</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-report-company">sales-report-company</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                <x-sidebar-item>
                    <x-sidebar-sub>
                        <x-slot name="title">Trans</x-slot>
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans">sales-trans</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans-company">sales-trans-company</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans-edit">sales-trans-edit</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans-export">sales-trans-export</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans-pay">sales-trans-pay</x-sidebar-link>
                        </x-sidebar-item>
        
                        <x-sidebar-item>
                            <x-sidebar-link href="/sales/sales-trans-sync">sales-trans-sync</x-sidebar-link>
                        </x-sidebar-item>
                    </x-sidebar-sub>
                </x-sidebar-item>

                

                

                
            </x-sidebar-nav>


        </x-menu>

    </x-simplebar>
</nav>
