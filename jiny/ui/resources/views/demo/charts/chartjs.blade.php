<x-jinyui-theme theme="adminkit" class="bootstrap">

            <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Chart.js</h1>



                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card flex-fill w-100">
                            <div class="card-header">
                                <h5 class="card-title">Line Chart</h5>
                                <h6 class="card-subtitle text-muted">A line chart is a way of plotting data points on a line.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.line")

                                


                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Bar Chart</h5>
                                <h6 class="card-subtitle text-muted">A bar chart provides a way of showing data values represented as vertical bars.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.bar")
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Doughnut Chart</h5>
                                <h6 class="card-subtitle text-muted">Doughnut charts are excellent at showing the relational proportions between data.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.doughnut")
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Pie Chart</h5>
                                <h6 class="card-subtitle text-muted">Pie charts are excellent at showing the relational proportions between data.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.pie")
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Radar Chart</h5>
                                <h6 class="card-subtitle text-muted">A radar chart is a way of showing multiple data points and the variation between them.
                                </h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.rader")
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Polar Area Chart</h5>
                                <h6 class="card-subtitle text-muted">Polar area charts are similar to pie charts, but each segment has the same angle.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.charts.chartjs.polar")
                            </div>
                        </div>
                    </div>
                </div>

            </div>

</x-jiny-theme>






