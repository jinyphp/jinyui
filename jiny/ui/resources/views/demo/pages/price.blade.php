<style>
    .tab-content>.tab-pane {
        display: none
    }
    
    .tab-content>.active {
        display: block
    }
</style>
<x-jinyui-theme theme="adminkit" class="bootstrap">

    <x-main-content>
        <x-container>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Plans &amp; Pricing</h1>
            </div>
            <x-row>
                <div class="col-md-10 col-xl-8 mx-auto">
                    <h1 class="text-center">We have a plan for everyone</h1>
                    <p class="lead text-center mb-4">Whether you're a business or an individual, 14-day trial no credit card required.</p>
    
                    <x-row-center class="mt-3 mb-2">
                        <x-tab-header group class="btn-group">
                            <x-tab-button href="#monthly" class="btn-outline-primary">Monthly billing</x-tab-button>
                            <x-tab-button href="#annual" active class="btn-outline-primary">Annual billing</x-tab-button>
                        </x-tab-header>
                    </x-row-center>
    
                    <x-tab-contents>
                        <x-tab-item id="monthly">
                            @include("jinyui::demo.pages.prices.monthly")
                        </x-tab-item>
                        <x-tab-item id="annual">
                            @include("jinyui::demo.pages.prices.annual")
                        </x-tab-item> 
                    </x-tab-contents> 
    
                </div>
            </x-row>

            <x-row>
                <div class="col-md-10 col-xl-8 mx-auto">
                    <hr>
                    @include("jinyui::demo.pages.prices.questions")
                </div>
            </x-row>

        </x-container>
    </x-main-content>



</x-jiny-theme>   