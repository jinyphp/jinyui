<x-theme theme="adminkit">
    <x-main-content>
        <x-container-fluid>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        	<li class="breadcrumb-item active">Analytics</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle"><strong>Analytics</strong> Dashboard</h1>
                            <p></p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->
            

            <div class="relative">
                <div class="absolute bottom-4 right-0">
                    <a href="#" class="btn btn-light bg-white me-2">Invite a Friend</a>
                <a href="#" class="btn btn-primary">New Project</a>
                </div>
            </div>

            <x-row>
                <x-col class="col-xl-6 col-xxl-5 d-flex"> 
                    <div class="w-100">
                        <x-row>
                            <x-col class="col-sm-6">
                                @widget("jinyui::demo.widgets.stats.summary_sales",[
                                    'title' => 'Sales',
                                    'icon' => xIcon("feather.shopping.cart"),
                                    'point' => '2.382',
                                    'rate' => xBadge("-3.65%",['class'=>"badge-danger-lighten"])
                                ])

                            
                                @include("jinyui::demo.widgets.stats.summary_visitors")
                            </x-col>

                            <x-col class="col-sm-6">
                                @include("jinyui::demo.widgets.stats.summary_earnings")
                                @include("jinyui::demo.widgets.stats.summary_orders")
                            </x-col>
                        </x-row>

                    </div>
                </x-col>

                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <div class="float-end">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <select class="form-select form-select-sm bg-light border-0">
                                            <option>Jan</option>
                                            <option value="1">Feb</option>
                                            <option value="2">Mar</option>
                                            <option value="3">Apr</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" class="form-control form-control-sm bg-light rounded-2 border-0" style="width: 100px;" placeholder="Search..">
                                    </div>
                                </form>
                            </div>
                            <h5 class="card-title mb-0">Recent Movement</h5>
                        </div>
                        <div class="card-body pt-2 pb-3">
                            <div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="chartjs-dashboard-line" style="display: block; width: 817px; height: 250px;" width="817" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
                                    var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
                                    gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
                                    gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
                                    var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
                                    gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
                                    gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");
                                    // Line chart
                                    new Chart(document.getElementById("chartjs-dashboard-line"), {
                                        type: "line",
                                        data: {
                                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                            datasets: [{
                                                label: "Sales ($)",
                                                fill: true,
                                                backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
                                                borderColor: window.theme.primary,
                                                data: [
                                                    2115,
                                                    1562,
                                                    1584,
                                                    1892,
                                                    1587,
                                                    1923,
                                                    2566,
                                                    2448,
                                                    2805,
                                                    3438,
                                                    2917,
                                                    3327
                                                ]
                                            }]
                                        },
                                        options: {
                                            maintainAspectRatio: false,
                                            legend: {
                                                display: false
                                            },
                                            tooltips: {
                                                intersect: false
                                            },
                                            hover: {
                                                intersect: true
                                            },
                                            plugins: {
                                                filler: {
                                                    propagate: false
                                                }
                                            },
                                            scales: {
                                                xAxes: [{
                                                    reverse: true,
                                                    gridLines: {
                                                        color: "rgba(0,0,0,0.0)"
                                                    }
                                                }],
                                                yAxes: [{
                                                    ticks: {
                                                        stepSize: 1000
                                                    },
                                                    display: true,
                                                    borderDash: [3, 3],
                                                    gridLines: {
                                                        color: "rgba(0,0,0,0.0)",
                                                        fontColor: "#fff"
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>

            </x-row>


            <div class="row">
                <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-3">
                    @include("jinyui::demo.widgets.browser_usage")
                </div>
                <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                    @include("jinyui::demo.widgets.realtime")
                </div>
                <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-1">
                    @include("jinyui::demo.widgets.calender")
                </div>
            </div>


            <x-row>
                <div class="col-12 col-lg-8 col-xxl-9 d-flex">
                    @include("jinyui::demo.widgets.projects")
                </div>
                <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                    @include("jinyui::demo.widgets.monthly")
                </div>
            </x-row>


        </x-container-fluid>
    </x-main-content>


</x-theme>