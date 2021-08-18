<x-theme-app>

    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
<style>
.az-dashboard-one-title {
    margin-bottom: 20px;
}

@media (min-width: 576px) {
    .az-dashboard-one-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
}

@media (min-width: 992px) {
    .az-dashboard-one-title {
        margin-bottom: 30px;
    }
}
.az-dashboard-title {
    font-size: 22px;
    font-weight: 700;
    color: #1c273c;
    letter-spacing: -1px;
    margin-bottom: 3px;
}
.az-dashboard-text {
    font-size: 13px;
    margin-bottom: 0;
}


.az-content-header-right {
    display: none;
}

@media (min-width: 992px) {
    .az-content-header-right {
        display: flex;
        align-items: center;
    }
}

.az-content-header-right .media label {
    margin-bottom: 2px;
    font-size: 10px;
    font-weight: 500;
    letter-spacing: .5px;
    text-transform: uppercase;
    color: #97a3b9;
}

.az-content-header-right .media h6 {
    color: #1c273c;
    margin-bottom: 0;
}

.az-content-header-right .media+.media {
    margin-left: 20px;
    padding-left: 20px;
    border-left: 1px solid #cdd4e0;
}

.az-content-header-right .btn:first-of-type,
.az-content-header-right .sp-container button:first-of-type,
.sp-container .az-content-header-right button:first-of-type {
    margin-left: 30px;
}

.az-content-header-right .btn+.btn,
.az-content-header-right .sp-container button+.btn,
.sp-container .az-content-header-right button+.btn,
.az-content-header-right .sp-container .btn+button,
.sp-container .az-content-header-right .btn+button,
.az-content-header-right .sp-container button+button,
.sp-container .az-content-header-right button+button {
    margin-left: 5px;
}
</style>

                <div class="az-dashboard-one-title">
                    <div>
                        <h2 class="az-dashboard-title">Hi, welcome back!</h2>
                        <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                    </div>
                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                                <label>Start Date</label>
                                <h6>Oct 10, 2018</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>End Date</label>
                                <h6>Oct 23, 2018</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>Event Category</label>
                                <h6>All Categories</h6>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <a href="" class="btn btn-purple">Export</a>
                    </div>
                </div><!-- az-dashboard-one-title -->

<style>

.az-dashboard-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #cdd4e0;
    margin-bottom: 20px;
}

.az-dashboard-nav .nav-link {
    font-size: 12px;
    padding: 5px 10px 8px;
    display: flex;
    align-items: center;
    line-height: 1;
}

@media (min-width: 576px) {
    .az-dashboard-nav .nav-link {
        font-size: 0.875rem;
    }
}

@media (min-width: 992px) {
    .az-dashboard-nav .nav-link {
        padding: 5px 15px 10px;
    }
}

.az-dashboard-nav .nav-link:hover,
.az-dashboard-nav .nav-link:focus {
    color: #5b47fb;
}

.az-dashboard-nav .nav-link+.nav-link {
    border-left: 1px solid #cdd4e0;
}

.az-dashboard-nav .nav:first-child .nav-link {
    color: #1c273c;
    display: none;
}

@media (min-width: 576px) {
    .az-dashboard-nav .nav:first-child .nav-link {
        display: block;
    }
}

.az-dashboard-nav .nav:first-child .nav-link:hover,
.az-dashboard-nav .nav:first-child .nav-link:focus {
    color: #5b47fb;
}

.az-dashboard-nav .nav:first-child .nav-link.active {
    color: #5b47fb;
}

.az-dashboard-nav .nav:first-child .nav-link:first-child {
    padding-left: 0;
}

.az-dashboard-nav .nav:first-child .nav-link:first-child,
.az-dashboard-nav .nav:first-child .nav-link:last-child {
    display: block;
}

.az-dashboard-nav .nav:last-child .nav-link {
    color: #596882;
    display: none;
}

@media (min-width: 768px) {
    .az-dashboard-nav .nav:last-child .nav-link {
        display: block;
    }
}

.az-dashboard-nav .nav:last-child .nav-link:hover,
.az-dashboard-nav .nav:last-child .nav-link:focus {
    color: #5b47fb;
}

.az-dashboard-nav .nav:last-child .nav-link i {
    font-size: 16px;
    margin-right: 7px;
    line-height: 0;
}

.az-dashboard-nav .nav:last-child .nav-link:last-child {
    padding-right: 0;
    display: block;
}

.az-dashboard-nav .nav:last-child .nav-link:last-child i {
    margin-right: 0;
}

@media (min-width: 768px) {
    .az-dashboard-nav .nav:last-child .nav-link:last-child {
        display: none;
    }
}
</style>                
                <div class="az-dashboard-nav">
                    <nav class="nav">
                        <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
                        <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
                        <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
                        <a class="nav-link" data-toggle="tab" href="#">More</a>
                    </nav>

                    <nav class="nav">
                        <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
                        <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
                        <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
                        <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
                    </nav>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-7 ht-lg-100p">
                        <div class="card card-dashboard-one">
                            <div class="card-header">
                                <div>
                                    <h6 class="card-title">Website Audience Metrics</h6>
                                    <p class="card-text">Audience to which the users belonged while on the current date
                                        range.</p>
                                </div>
                                <div class="btn-group">
                                    <button class="btn active">Day</button>
                                    <button class="btn">Week</button>
                                    <button class="btn">Month</button>
                                </div>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="card-body-top">
                                    <div>
                                        <label class="mg-b-0">Users</label>
                                        <h2>13,956</h2>
                                    </div>
                                    <div>
                                        <label class="mg-b-0">Bounce Rate</label>
                                        <h2>33.50%</h2>
                                    </div>
                                    <div>
                                        <label class="mg-b-0">Page Views</label>
                                        <h2>83,123</h2>
                                    </div>
                                    <div>
                                        <label class="mg-b-0">Sessions</label>
                                        <h2>16,869</h2>
                                    </div>
                                </div><!-- card-body-top -->
                                <div class="flot-chart-wrapper">
                                    <div id="flotChart" class="flot-chart" style="padding: 0px; position: relative;">
                                        <canvas class="flot-base" width="597" height="252"
                                            style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 597.656px; height: 252px;"></canvas>
                                        <div class="flot-text"
                                            style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                            <div class="flot-x-axis flot-x1-axis xAxis x1Axis"
                                                style="position: absolute; inset: 0px;">
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; max-width: 175px; top: 236px; left: 102px; text-align: center;">
                                                    OCT 21</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; max-width: 175px; top: 236px; left: 287px; text-align: center;">
                                                    OCT 22</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; max-width: 175px; top: 236px; left: 379px; text-align: center;">
                                                    OCT 23</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; max-width: 175px; top: 236px; left: 472px; text-align: center;">
                                                    OCT 24</div>
                                            </div>
                                            <div class="flot-y-axis flot-y1-axis yAxis y1Axis"
                                                style="position: absolute; inset: 0px;">
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; top: 176px; left: 0px; text-align: right;">
                                                    20K</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; top: 132px; left: 0px; text-align: right;">
                                                    40K</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; top: 88px; left: 0px; text-align: right;">
                                                    60K</div>
                                                <div class="flot-tick-label tickLabel"
                                                    style="position: absolute; top: 44px; left: 0px; text-align: right;">
                                                    80K</div>
                                            </div>
                                        </div><canvas class="flot-overlay" width="597" height="252"
                                            style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 597.656px; height: 252px;"></canvas>
                                    </div>
                                </div><!-- flot-chart-wrapper -->
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div><!-- col -->
                    <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                        <div class="row row-sm">
                            <div class="col-sm-6">
                                <div class="card card-dashboard-two">
                                    <div class="card-header">
                                        <h6>33.50% <i class="icon ion-md-trending-up tx-success"></i>
                                            <small>18.02%</small></h6>
                                        <p>Bounce Rate</p>
                                    </div><!-- card-header -->
                                    <div class="card-body">
                                        <div class="chart-wrapper">
                                            <div id="flotChart1" class="flot-chart"
                                                style="padding: 0px; position: relative;"><canvas class="flot-base"
                                                    width="202" height="100"
                                                    style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 202.156px; height: 100px;"></canvas><canvas
                                                    class="flot-overlay" width="202" height="100"
                                                    style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 202.156px; height: 100px;"></canvas>
                                            </div>
                                        </div><!-- chart-wrapper -->
                                    </div><!-- card-body -->
                                </div><!-- card -->
                            </div><!-- col -->
                            <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                                <div class="card card-dashboard-two">
                                    <div class="card-header">
                                        <h6>86k <i class="icon ion-md-trending-down tx-danger"></i> <small>0.86%</small>
                                        </h6>
                                        <p>Total Users</p>
                                    </div><!-- card-header -->
                                    <div class="card-body">
                                        <div class="chart-wrapper">
                                            <div id="flotChart2" class="flot-chart"
                                                style="padding: 0px; position: relative;"><canvas class="flot-base"
                                                    width="202" height="100"
                                                    style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 202.156px; height: 100px;"></canvas><canvas
                                                    class="flot-overlay" width="202" height="100"
                                                    style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 202.156px; height: 100px;"></canvas>
                                            </div>
                                        </div><!-- chart-wrapper -->
                                    </div><!-- card-body -->
                                </div><!-- card -->
                            </div><!-- col -->
                            <div class="col-sm-12 mg-t-20">
                                <div class="card card-dashboard-three">
                                    <div class="card-header">
                                        <p>All Sessions</p>
                                        <h6>16,869 <small class="tx-success"><i class="icon ion-md-arrow-up"></i>
                                                2.87%</small></h6>
                                        <small>The total number of sessions within the date range. It is the period time
                                            a user is actively engaged with your website, page or app, etc.</small>
                                    </div><!-- card-header -->
                                    <div class="card-body">
                                        <div class="chart">
                                            <div class="chartjs-size-monitor"
                                                style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                                <div class="chartjs-size-monitor-expand"
                                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div
                                                        style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                                    </div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink"
                                                    style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                                                    </div>
                                                </div>
                                            </div><canvas id="chartBar5" width="293" height="200"
                                                style="display: block; width: 293px; height: 200px;"
                                                class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div>
                    <!--col -->
                </div><!-- row -->

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-4">
<style>
    
.card-dashboard-pageviews {
    border-color: #cdd4e0;
    border-radius: 0;
    padding: 20px;
}

.card-dashboard-pageviews .card-header {
    background-color: transparent;
    padding: 0 0 10px;
}

.card-dashboard-pageviews .card-title {
    font-weight: 700;
    font-size: 14px;
    color: #1c273c;
    margin-bottom: 5px;
}

.card-dashboard-pageviews .card-text {
    font-size: 13px;
    margin-bottom: 0;
}

.card-dashboard-pageviews .card-body {
    padding: 0;
}
</style>
                        <div class="card card-dashboard-pageviews">
                            <div class="card-header">
                                <h6 class="card-title">Page Views by Page Title</h6>
                                <p class="card-text">This report is based on 100% of sessions.</p>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <div class="az-list-item">
                                    <div>
                                        <h6>Admin Home</h6>
                                        <span>/demo/admin/index.html</span>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">7,755</h6>
                                        <span>31.74% (-100.00%)</span>
                                    </div>
                                </div><!-- list-group-item -->
                                <div class="az-list-item">
                                    <div>
                                        <h6>Form Elements</h6>
                                        <span>/demo/admin/forms.html</span>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">5,215</h6>
                                        <span>28.53% (-100.00%)</span>
                                    </div>
                                </div><!-- list-group-item -->
                                <div class="az-list-item">
                                    <div>
                                        <h6>Utilities</h6>
                                        <span>/demo/admin/util.html</span>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">4,848</h6>
                                        <span>25.35% (-100.00%)</span>
                                    </div>
                                </div><!-- list-group-item -->
                                <div class="az-list-item">
                                    <div>
                                        <h6>Form Validation</h6>
                                        <span>/demo/admin/validation.html</span>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">3,275</h6>
                                        <span>23.17% (-100.00%)</span>
                                    </div>
                                </div><!-- list-group-item -->
                                <div class="az-list-item">
                                    <div>
                                        <h6>Modals</h6>
                                        <span>/demo/admin/modals.html</span>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">3,003</h6>
                                        <span>22.21% (-100.00%)</span>
                                    </div>
                                </div><!-- list-group-item -->
                            </div><!-- card-body -->
                        </div><!-- card -->

                    </div><!-- col -->
                    <div class="col-lg-8 mg-t-20 mg-lg-t-0">
                        <div class="card card-dashboard-four">
                            <div class="card-header">
                                <h6 class="card-title">Sessions by Channel</h6>
                            </div><!-- card-header -->
                            <div class="card-body row">
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="chart">
                                        <div class="chartjs-size-monitor"
                                            style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                            <div class="chartjs-size-monitor-expand"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div
                                                    style="position:absolute;width:1000000px;height:1000000px;left:0;top:0">
                                                </div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink"
                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                                <div style="position:absolute;width:200%;height:200%;left:0; top:0">
                                                </div>
                                            </div>
                                        </div><canvas id="chartDonut" width="300" height="257"
                                            style="display: block; width: 300px; height: 257px;"
                                            class="chartjs-render-monitor"></canvas>
                                    </div>
                                </div><!-- col -->
                                <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Organic Search</span>
                                            <span>1,320 <span>(25%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-purple wd-25p" role="progressbar"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- progress -->
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Email</span>
                                            <span>987 <span>(20%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary wd-20p" role="progressbar"
                                                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- progress -->
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Referral</span>
                                            <span>2,010 <span>(30%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info wd-30p" role="progressbar"
                                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- progress -->
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Social</span>
                                            <span>654 <span>(15%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-teal wd-15p" role="progressbar"
                                                aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- progress -->
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Other</span>
                                            <span>400 <span>(10%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-gray-500 wd-10p" role="progressbar"
                                                aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div><!-- progress -->
                                    </div>
                                </div><!-- col -->
                            </div><!-- card-body -->
                        </div><!-- card-dashboard-four -->
                    </div><!-- col -->
                </div><!-- row -->

                <div class="row row-sm mg-b-20 mg-lg-b-0">
                    <div class="col-lg-5 col-xl-4">
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                                <div class="card card-dashboard-five">
                                    <div class="card-header">
                                        <h6 class="card-title">Acquisition</h6>
                                        <span class="card-text">Tells you where your visitors originated from, such as
                                            search engines, social networks or website referrals.</span>
                                    </div><!-- card-header -->
                                    <div class="card-body row row-sm">
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-primary">
                                                <span class="peity-bar"
                                                    data-peity="{&quot;fill&quot;: [&quot;#fff&quot;], &quot;width&quot;: 20, &quot;height&quot;: 20 }"
                                                    style="display: none;">6,4,7,5,7</span><svg class="peity"
                                                    height="20" width="20">
                                                    <rect data-value="6" fill="#fff" x="0.4" y="2.8571428571428577"
                                                        width="3.2" height="17.142857142857142"></rect>
                                                    <rect data-value="4" fill="#fff" x="4.4" y="8.571428571428573"
                                                        width="3.1999999999999993" height="11.428571428571427"></rect>
                                                    <rect data-value="7" fill="#fff" x="8.4" y="0"
                                                        width="3.1999999999999993" height="20"></rect>
                                                    <rect data-value="5" fill="#fff" x="12.4" y="5.7142857142857135"
                                                        width="3.1999999999999993" height="14.285714285714286"></rect>
                                                    <rect data-value="7" fill="#fff" x="16.4" y="0"
                                                        width="3.200000000000003" height="20"></rect>
                                                </svg>
                                            </div>
                                            <div>
                                                <label>Bounce Rate</label>
                                                <h4>33.50%</h4>
                                            </div>
                                        </div><!-- col -->
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-purple">
                                                <span class="peity-bar"
                                                    data-peity="{&quot;fill&quot;: [&quot;#fff&quot;], &quot;width&quot;: 21, &quot;height&quot;: 20 }"
                                                    style="display: none;">7,4,5,7,2</span><svg class="peity"
                                                    height="20" width="21">
                                                    <rect data-value="7" fill="#fff" x="0.42000000000000004" y="0"
                                                        width="3.3600000000000003" height="20"></rect>
                                                    <rect data-value="4" fill="#fff" x="4.62" y="8.571428571428573"
                                                        width="3.3599999999999994" height="11.428571428571427"></rect>
                                                    <rect data-value="5" fill="#fff" x="8.82" y="5.7142857142857135"
                                                        width="3.3599999999999994" height="14.285714285714286"></rect>
                                                    <rect data-value="7" fill="#fff" x="13.020000000000001" y="0"
                                                        width="3.3599999999999977" height="20"></rect>
                                                    <rect data-value="2" fill="#fff" x="17.22" y="14.285714285714286"
                                                        width="3.360000000000003" height="5.7142857142857135"></rect>
                                                </svg>
                                            </div>
                                            <div>
                                                <label>Sessions</label>
                                                <h4>9,065</h4>
                                            </div>
                                        </div><!-- col -->
                                    </div><!-- card-body -->
                                </div><!-- card-dashboard-five -->
                            </div><!-- col -->
                            <div class="col-md-6 col-lg-12">
                                <div class="card card-dashboard-five">
                                    <div class="card-header">
                                        <h6 class="card-title">Sessions</h6>
                                        <span class="card-text"> A session is the period time a user is actively engaged
                                            with your website, app, etc.</span>
                                    </div><!-- card-header -->
                                    <div class="card-body row row-sm">
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                                                <span class="peity-donut"
                                                    data-peity="{ &quot;fill&quot;: [&quot;#007bff&quot;, &quot;#cad0e8&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }"
                                                    style="display: none;">4/7</span><svg class="peity" height="40"
                                                    width="40">
                                                    <path
                                                        d="M 20 0 A 20 20 0 1 1 11.322325217648839 38.01937735804839 L 13.925627652354187 32.61356415063387 A 14 14 0 1 0 20 6"
                                                        data-value="4" fill="#007bff"></path>
                                                    <path
                                                        d="M 11.322325217648839 38.01937735804839 A 20 20 0 0 1 19.999999999999996 0 L 19.999999999999996 6 A 14 14 0 0 0 13.925627652354187 32.61356415063387"
                                                        data-value="3" fill="#cad0e8"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <label>% New Sessions</label>
                                                <h4>26.80%</h4>
                                            </div>
                                        </div><!-- col -->
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="mg-b-10 mg-sm-b-0 mg-sm-r-10">
                                                <span class="peity-donut"
                                                    data-peity="{ &quot;fill&quot;: [&quot;#00cccc&quot;, &quot;#cad0e8&quot;],  &quot;innerRadius&quot;: 14, &quot;radius&quot;: 20 }"
                                                    style="display: none;">2/7</span><svg class="peity" height="40"
                                                    width="40">
                                                    <path
                                                        d="M 20 0 A 20 20 0 0 1 39.498558243636474 24.450418679126287 L 33.64899077054553 23.1152930753884 A 14 14 0 0 0 20 6"
                                                        data-value="2" fill="#00cccc"></path>
                                                    <path
                                                        d="M 39.498558243636474 24.450418679126287 A 20 20 0 1 1 19.999999999999996 0 L 19.999999999999996 6 A 14 14 0 1 0 33.64899077054553 23.1152930753884"
                                                        data-value="5" fill="#cad0e8"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <label>Pages/Session</label>
                                                <h4>1,005</h4>
                                            </div>
                                        </div><!-- col -->
                                    </div><!-- card-body -->
                                </div><!-- card-dashboard-five -->
                            </div><!-- col -->
                        </div><!-- row -->
                    </div><!-- col-lg-3 -->
                    <div class="col-lg-7 col-xl-8 mg-t-20 mg-lg-t-0">
                        <div class="card card-table-one">
                            <h6 class="card-title">What pages do your users visit</h6>
                            <p class="az-content-text mg-b-20">Part of this date range occurs before the new users
                                metric had been calculated, so the old users metric is displayed.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="wd-5p">&nbsp;</th>
                                            <th class="wd-45p">Country</th>
                                            <th>Entrances</th>
                                            <th>Bounce Rate</th>
                                            <th>Exits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-us flag-icon-squared"></i></td>
                                            <td><strong>United States</strong></td>
                                            <td><strong>134</strong> (1.51%)</td>
                                            <td>33.58%</td>
                                            <td>15.47%</td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-gb flag-icon-squared"></i></td>
                                            <td><strong>United Kingdom</strong></td>
                                            <td><strong>290</strong> (3.30%)</td>
                                            <td>9.22%</td>
                                            <td>7.99%</td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-in flag-icon-squared"></i></td>
                                            <td><strong>India</strong></td>
                                            <td><strong>250</strong> (3.00%)</td>
                                            <td>20.75%</td>
                                            <td>2.40%</td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-ca flag-icon-squared"></i></td>
                                            <td><strong>Canada</strong></td>
                                            <td><strong>216</strong> (2.79%)</td>
                                            <td>32.07%</td>
                                            <td>15.09%</td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-fr flag-icon-squared"></i></td>
                                            <td><strong>France</strong></td>
                                            <td><strong>216</strong> (2.79%)</td>
                                            <td>32.07%</td>
                                            <td>15.09%</td>
                                        </tr>
                                        <tr>
                                            <td><i class="flag-icon flag-icon-ph flag-icon-squared"></i></td>
                                            <td><strong>Philippines</strong></td>
                                            <td><strong>197</strong> (2.12%)</td>
                                            <td>32.07%</td>
                                            <td>15.09%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- table-responsive -->
                        </div><!-- card -->
                    </div><!-- col-lg -->

                </div><!-- row -->
            </div><!-- az-content-body -->
        </div>
    </div>

</x-theme-app>
