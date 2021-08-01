<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">ApexCharts</h1><a class="badge bg-primary ms-2"
                href="https://adminkit.io/pricing/" target="_blank">Pro Component 
				<i class="fas fa-fw fa-external-link-alt"></i></a>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Line Chart</h5>
                        <h6 class="card-subtitle text-muted">Line charts are a typical pictorial representation that
                            depicts trends and behaviors
                            over time.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.line")
                    </div>
				</x-card>
                    
              
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Area Chart</h5>
                        <h6 class="card-subtitle text-muted">Area charts are used to represent quantitative variations.
                        </h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.area")
                    </div>
				</x-card>

            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Bar Chart</h5>
                        <h6 class="card-subtitle text-muted">A bar chart is the best tool for displaying comparisons
                            between categories of data.
                        </h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.bar")
                    </div>
				</x-card>
                    
               
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Column Chart</h5>
                        <h6 class="card-subtitle text-muted">A column chart uses vertical bars to display data and is
                            used to compare values across
                            categories.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.column")
                    </div>
				</x-card>
          
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Pie Chart</h5>
                        <h6 class="card-subtitle text-muted">Pie charts are an instrumental visualization tool useful in
                            expressing data and
                            information in terms of percentages, ratio.</h6>
                    </div>
                    <div class="card-body text-center">
                        @include("jinyui::demo.charts.apex.pie")
                    </div>
				</x-card>
             
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Heatmap Chart</h5>
                        <h6 class="card-subtitle text-muted">Heatmap is a visualization tool that employs color the way
                            a bar chart employs height
                            and width in representing data.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.heatmap")
                    </div>
				</x-card>
                    
               
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Mixed Chart</h5>
                        <h6 class="card-subtitle text-muted">A Mixed Chart is a visualization that allows the
                            combination of two or more distinct
                            graphs.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.mixed")
                    </div>
				</x-card>
             
            </div>

            <div class="col-12 col-lg-6">
                <x-card>
					<div class="card-header">
                        <h5 class="card-title">Candlestick Chart</h5>
                        <h6 class="card-subtitle text-muted">A candlestick chart is a style of financial chart used to
                            describe price movements.
                        </h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.charts.apex.candle")
                    </div>
				</x-card>
                    
           
            </div>
        </div>

    </div>

</x-jinyui-theme>
