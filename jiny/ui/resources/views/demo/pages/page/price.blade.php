<style>
    .tab-content>.tab-pane {
        display: none
    }
    
    .tab-content>.active {
        display: block
    }
</style>
<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Plans &amp; Pricing</h1><a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">Pro Component <i class="fas fa-fw fa-external-link-alt"></i></a>
        </div>

        <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
                <h1 class="text-center">We have a plan for everyone</h1>
                <p class="lead text-center mb-4">Whether you're a business or an individual, 14-day trial no credit card required.</p>

                <div class="row justify-content-center mt-3 mb-2">
                    <div class="col-auto">

                        <nav class="nav btn-group">
                            <a href="#monthly" class="btn btn-outline-primary active" data-bs-toggle="tab">Monthly billing</a>
                            <a href="#annual" class="btn btn-outline-primary" data-bs-toggle="tab">Annual billing</a>
                        </nav>

                    </div>
                </div>

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="monthly">
                        @include("jinyui::demo.pages.page.prices.monthly")
                    </div>

                    <div class="tab-pane fade" id="annual">
                        @include("jinyui::demo.pages.page.prices.annual")
                    </div>

                </div>

                <hr>
                @include("jinyui::demo.pages.page.prices.questions")
                
            </div>
        </div>

    </div>

</x-jiny-theme>   