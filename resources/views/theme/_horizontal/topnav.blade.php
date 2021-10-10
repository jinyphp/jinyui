<style>




.topnav-navbar-dark {
    background-color: #313a46
}

.topnav-navbar-dark .nav-user {
    background-color: #3c4655;
    border: 1px solid #414d5d
}

.topnav-navbar-dark .topbar-menu li .show.nav-link {
    color: #fff !important
}

.topnav-navbar-dark .app-search .form-control {
    background-color: #3c4655;
    color: #fff
}

.topnav-navbar-dark .app-search span {
    color: #98a6ad
}

.topnav-navbar-dark .navbar-toggle span {
    background-color: rgba(255, 255, 255, .8) !important
}

.arrow-none:after {
    display: none
}


@media (max-width:991.98px) {
    .topnav-navbar .topnav-logo-lg {
        display: none
    }

    .topnav-navbar .topnav-logo {
        min-width: 50px;
        padding-right: 0;
        text-align: center
    }

    .topnav-navbar .topnav-logo-sm {
        display: block !important
    }

    .topnav .navbar-nav .nav-link {
        padding: .75rem 1.3rem
    }

    .topnav .dropdown .dropdown-menu {
        background-color: transparent;
        border: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 15px
    }

    .topnav .dropdown .dropdown-item {
        position: relative;
        background-color: transparent
    }

    .topnav .navbar-dark .dropdown .dropdown-item {
        color: rgba(255, 255, 255, .5)
    }

    .topnav .navbar-dark .dropdown .dropdown-item.active,
    .topnav .navbar-dark .dropdown .dropdown-item:active {
        color: #fff
    }

    .topnav .arrow-down::after {
        right: 15px;
        position: absolute
    }
}


.topnav-navbar {
    padding: 0;
    margin: 0;
    min-height: 70px;
    position: relative;
    left: 0 !important;
    z-index: 1002
}

.topnav-navbar .topnav-logo {
    line-height: 70px;
    float: left;
    padding-right: 20px;
    min-width: 160px
}

.topnav-navbar .topnav-logo .topnav-logo-sm {
    display: none
}

.topnav-navbar .navbar-toggle {
    position: relative;
    cursor: pointer;
    float: left;
    margin: 27px 20px;
    padding: 0;
    background-color: transparent;
    border: none
}

.topnav-navbar .navbar-toggle .lines {
    width: 25px;
    display: block;
    position: relative;
    height: 16px;
    -webkit-transition: all .5s ease;
    transition: all .5s ease
}

.topnav-navbar .navbar-toggle span {
    height: 2px;
    width: 100%;
    background-color: rgba(49, 58, 70, .8);
    display: block;
    margin-bottom: 5px;
    -webkit-transition: -webkit-transform .5s ease;
    transition: -webkit-transform .5s ease;
    transition: transform .5s ease;
    transition: transform .5s ease, -webkit-transform .5s ease
}

.topnav-navbar .navbar-toggle.open span {
    position: absolute
}

.topnav-navbar .navbar-toggle.open span:first-child {
    top: 7px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg)
}

.topnav-navbar .navbar-toggle.open span:nth-child(2) {
    visibility: hidden
}

.topnav-navbar .navbar-toggle.open span:last-child {
    width: 100%;
    top: 7px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg)
}

.topnav-navbar .app-search {
    float: left
}

.topnav {
    background: #313a46
}

.topnav .topnav-menu {
    margin: 0;
    padding: 0
}

.topnav .navbar-nav .nav-link {
    font-size: .9375rem;
    position: relative;
    padding: 1rem 1.3rem
}

.topnav .nav-item.active>a {
    color: #727cf5
}

.topnav .navbar-dark .dropdown.active>.nav-link,
.topnav .navbar-dark .dropdown:active>.nav-link {
    color: #fff
}

.arrow-down:after {
    border-color: initial;
    border-style: solid;
    border-width: 0 0 1px 1px;
    content: "";
    height: .4em;
    display: inline-block;
    right: 5px;
    top: 50%;
    margin-left: 10px;
    -webkit-transform: rotate(-45deg) translateY(-50%);
    transform: rotate(-45deg) translateY(-50%);
    -webkit-transform-origin: top;
    transform-origin: top;
    -webkit-transition: all .3s ease-out;
    transition: all .3s ease-out;
    width: .4em
}

.arrow-down {
    display: inline-block
}

@media (min-width:992px) {
    body[data-layout=topnav] .container-lg,
    body[data-layout=topnav] .container-md,
    body[data-layout=topnav] .container-sm,
    body[data-layout=topnav] .container-xl,
    body[data-layout=topnav] .container-xxl {
        max-width: 95%
    }

    body[data-layout=topnav][data-layout-mode=boxed] .container-fluid,
    body[data-layout=topnav][data-layout-mode=boxed] .container-lg,
    body[data-layout=topnav][data-layout-mode=boxed] .container-md,
    body[data-layout=topnav][data-layout-mode=boxed] .container-sm,
    body[data-layout=topnav][data-layout-mode=boxed] .container-xl,
    body[data-layout=topnav][data-layout-mode=boxed] .container-xxl {
        max-width: 97%
    }
    
    .topnav .navbar-nav .nav-item:first-of-type .nav-link {
        padding-left: 0
    }

    .topnav .dropdown .dropdown-menu {
        margin-top: 0;
        border-radius: 0 0 .25rem .25rem;
        min-width: calc(10rem + 1.5rem);
        font-size: calc(.9rem - .01rem)
    }

    .topnav .dropdown .dropdown-menu .arrow-down::after {
        right: 15px;
        -webkit-transform: rotate(-135deg) translateY(-50%);
        transform: rotate(-135deg) translateY(-50%);
        position: absolute
    }

    .topnav .dropdown .dropdown-menu .dropdown .dropdown-menu {
        position: absolute;
        top: 0;
        left: 100%;
        display: none
    }

    .topnav .dropdown:hover>.dropdown-menu {
        display: block
    }

    .topnav .dropdown:hover>.dropdown-menu>.dropdown:hover>.dropdown-menu {
        display: block
    }
    .dropdown.active>a.dropdown-item {
        color: #313a46;
        background-color: #f2f5f9
    }
}
</style>

<div class="topnav">
    <div class="container-fluid active">

        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse active" id="topnav-menu-content">

                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-dashboard me-1"></i>Dashboards <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="dashboard-analytics.html" class="dropdown-item">Analytics</a>
                            <a href="dashboard-crm.html" class="dropdown-item">CRM</a>
                            <a href="index.html" class="dropdown-item">Ecommerce</a>
                            <a href="dashboard-projects.html" class="dropdown-item">Projects</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-apps me-1"></i>Apps <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="apps-calendar.html" class="dropdown-item">Calendar</a>
                            <a href="apps-chat.html" class="dropdown-item">Chat</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ecommerce <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                    <a href="apps-ecommerce-products.html" class="dropdown-item">Products</a>
                                    <a href="apps-ecommerce-products-details.html" class="dropdown-item">Products Details</a>
                                    <a href="apps-ecommerce-orders.html" class="dropdown-item">Orders</a>
                                    <a href="apps-ecommerce-orders-details.html" class="dropdown-item">Order Details</a>
                                    <a href="apps-ecommerce-customers.html" class="dropdown-item">Customers</a>
                                    <a href="apps-ecommerce-shopping-cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="apps-ecommerce-checkout.html" class="dropdown-item">Checkout</a>
                                    <a href="apps-ecommerce-sellers.html" class="dropdown-item">Sellers</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Email <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="apps-email-inbox.html" class="dropdown-item">Inbox</a>
                                    <a href="apps-email-read.html" class="dropdown-item">Read Email</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-project" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Projects <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-project">
                                    <a href="apps-projects-list.html" class="dropdown-item">List</a>
                                    <a href="apps-projects-details.html" class="dropdown-item">Details</a>
                                    <a href="apps-projects-gantt.html" class="dropdown-item">Gantt</a>
                                    <a href="apps-projects-add.html" class="dropdown-item">Create Project</a>
                                </div>
                            </div>
                            <a href="apps-social-feed.html" class="dropdown-item">Social Feed</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tasks" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tasks <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tasks">
                                    <a href="apps-tasks.html" class="dropdown-item">List</a>
                                    <a href="apps-tasks-details.html" class="dropdown-item">Details</a>
                                    <a href="apps-kanban.html" class="dropdown-item">Kanban Board</a>
                                </div>
                            </div>
                            <a href="apps-file-manager.html" class="dropdown-item">File Manager</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-copy-alt me-1"></i>Pages <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Authenitication <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="pages-login.html" class="dropdown-item">Login</a>
                                    <a href="pages-login-2.html" class="dropdown-item">Login 2</a>
                                    <a href="pages-register.html" class="dropdown-item">Register</a>
                                    <a href="pages-register-2.html" class="dropdown-item">Register 2</a>
                                    <a href="pages-logout.html" class="dropdown-item">Logout</a>
                                    <a href="pages-logout-2.html" class="dropdown-item">Logout 2</a>
                                    <a href="pages-recoverpw.html" class="dropdown-item">Recover Password</a>
                                    <a href="pages-recoverpw-2.html" class="dropdown-item">Recover Password 2</a>
                                    <a href="pages-lock-screen.html" class="dropdown-item">Lock Screen</a>
                                    <a href="pages-lock-screen-2.html" class="dropdown-item">Lock Screen 2</a>
                                    <a href="pages-confirm-mail.html" class="dropdown-item">Confirm Mail</a>
                                    <a href="pages-confirm-mail-2.html" class="dropdown-item">Confirm Mail 2</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Error <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-error">
                                    <a href="pages-404.html" class="dropdown-item">Error 404</a>
                                    <a href="pages-404-alt.html" class="dropdown-item">Error 404-alt</a>
                                    <a href="pages-500.html" class="dropdown-item">Error 500</a>
                                </div>
                            </div>
                            <a href="pages-starter.html" class="dropdown-item">Starter Page</a>
                            <a href="pages-preloader.html" class="dropdown-item">With Preloader</a>
                            <a href="pages-profile.html" class="dropdown-item">Profile</a>
                            <a href="pages-profile-2.html" class="dropdown-item">Profile 2</a>
                            <a href="pages-invoice.html" class="dropdown-item">Invoice</a>
                            <a href="pages-faq.html" class="dropdown-item">FAQ</a>
                            <a href="pages-pricing.html" class="dropdown-item">Pricing</a>
                            <a href="pages-maintenance.html" class="dropdown-item">Maintenance</a>
                            <a href="pages-timeline.html" class="dropdown-item">Timeline</a>
                            <a href="landing.html" class="dropdown-item">Landing</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-package me-1"></i>Components <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <a href="widgets.html" class="dropdown-item">Widgets</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Base UI 1 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit">
                                    <a href="ui-accordions.html" class="dropdown-item">Accordions</a>
                                    <a href="ui-alerts.html" class="dropdown-item">Alerts</a>
                                    <a href="ui-avatars.html" class="dropdown-item">Avatars</a>
                                    <a href="ui-badges.html" class="dropdown-item">Badges</a>
                                    <a href="ui-breadcrumb.html" class="dropdown-item">Breadcrumb</a>
                                    <a href="ui-buttons.html" class="dropdown-item">Buttons</a>
                                    <a href="ui-cards.html" class="dropdown-item">Cards</a>
                                    <a href="ui-carousel.html" class="dropdown-item">Carousel</a>
                                    <a href="ui-dropdowns.html" class="dropdown-item">Dropdowns</a>
                                    <a href="ui-embed-video.html" class="dropdown-item">Embed Video</a>
                                    <a href="ui-grid.html" class="dropdown-item">Grid</a>
                                    <a href="ui-list-group.html" class="dropdown-item">List Group</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ui-kit2" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Base UI 2 <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ui-kit2">
                                    <a href="ui-modals.html" class="dropdown-item">Modals</a>
                                    <a href="ui-notifications.html" class="dropdown-item">Notifications</a>
                                    <a href="ui-offcanvas.html" class="dropdown-item">Offcanvas</a>
                                    <a href="ui-pagination.html" class="dropdown-item">Pagination</a>
                                    <a href="ui-popovers.html" class="dropdown-item">Popovers</a>
                                    <a href="ui-progress.html" class="dropdown-item">Progress</a>
                                    <a href="ui-ribbons.html" class="dropdown-item">Ribbons</a>
                                    <a href="ui-spinners.html" class="dropdown-item">Spinners</a>
                                    <a href="ui-tabs.html" class="dropdown-item">Tabs</a>
                                    <a href="ui-tooltips.html" class="dropdown-item">Tooltips</a>
                                    <a href="ui-typography.html" class="dropdown-item">Typography</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended-ui" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Extended UI <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-extended-ui">
                                    <a href="extended-dragula.html" class="dropdown-item">Dragula</a>
                                    <a href="extended-range-slider.html" class="dropdown-item">Range Slider</a>
                                    <a href="extended-ratings.html" class="dropdown-item">Ratings</a>
                                    <a href="extended-scrollbar.html" class="dropdown-item">Scrollbar</a>
                                    <a href="extended-scrollspy.html" class="dropdown-item">Scrollspy</a>
                                    <a href="extended-treeview.html" class="dropdown-item">Treeview</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-forms" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Forms <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-forms">
                                    <a href="form-elements.html" class="dropdown-item">Basic Elements</a>
                                    <a href="form-advanced.html" class="dropdown-item">Form Advanced</a>
                                    <a href="form-validation.html" class="dropdown-item">Validation</a>
                                    <a href="form-wizard.html" class="dropdown-item">Wizard</a>
                                    <a href="form-fileuploads.html" class="dropdown-item">File Uploads</a>
                                    <a href="form-editors.html" class="dropdown-item">Editors</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Charts <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="charts-chartjs.html" class="dropdown-item">Chartjs</a>
                                    <a href="charts-brite.html" class="dropdown-item">Britecharts</a>
                                    <a href="charts-apex-line.html" class="dropdown-item">Apex Charts</a>
                                    <a href="charts-sparkline.html" class="dropdown-item">Sparklines</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tables" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tables <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tables">
                                    <a href="tables-basic.html" class="dropdown-item">Basic Tables</a>
                                    <a href="tables-datatable.html" class="dropdown-item">Data Tables</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Icons <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-dripicons.html" class="dropdown-item">Dripicons</a>
                                    <a href="icons-mdi.html" class="dropdown-item">Material Design</a>
                                    <a href="icons-unicons.html" class="dropdown-item">Unicons</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-maps" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Maps <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-maps">
                                    <a href="maps-google.html" class="dropdown-item">Google Maps</a>
                                    <a href="maps-vector.html" class="dropdown-item">Vector Maps</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layouts" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-window me-1"></i>Layouts <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layouts">
                            <a href="index.html" class="dropdown-item">Vertical</a>
                            <a href="layouts-detached.html" class="dropdown-item">Detached</a>
                            <a href="layouts-horizontal.html" class="dropdown-item active">Horizontal</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>