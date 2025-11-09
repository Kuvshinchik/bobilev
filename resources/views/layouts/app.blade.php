<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <title>@yield('title', 'Зима/Лето')</title>
    <meta content="@yield('meta_description', 'Admin Dashboard')" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    {{-- Base CSS --}}
    <link href="{{ asset('assets/plugins/morris/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    {{-- Page-level styles --}}
    @stack('styles')
</head>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ url('/') }}" class="logo"><i class="mdi mdi-assistant"></i> ДЖВ Зима/Лето</a>
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">
                <div id="sidebar-menu">
                    {{-- Default sidebar --}}
                    <ul>
                        <li class="menu-title">Main</li>

                        <li>
                            <a href="{{ url('/') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        {{-- Дополнительное меню из дочерних вьюх --}}
                        @yield('sidebar')
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">
                    <nav class="navbar-custom">
                        <ul class="list-inline float-right mb-0">
                            {{-- Пример дропдаунов. При необходимости переопредели/скрой в CSS --}}
                            <li class="list-inline-item dropdown notification-list hide-phone">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect text-white" data-bs-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    Русский <img src="{{ asset('assets/images/flags/russia_flag.jpg') }}" class="ms-2" height="16" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end language-switch">
                                    <a class="dropdown-item" href="#"><img src="{{ asset('assets/images/flags/us_flag.jpg') }}" alt="" height="16"/><span> English </span></a>
                                </div>
                            </li>

                            {{-- Профиль/уведомления можно оставить как декор --}}
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-bs-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle me-2 text-muted"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-logout me-2 text-muted"></i> Logout</a>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>

                            {{-- Глобальный поиск; при желании замени на форму --}}
                            <li class="hide-phone app-search">
                                @yield('top-search')
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </nav>
                </div>
                <!-- Top Bar End -->

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        {{-- Page header (title + breadcrumbs) --}}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <div class="btn-group float-end">
                                        <ol class="breadcrumb hide-phone p-0 m-0">
                                            @yield('breadcrumb')
                                        </ol>
                                    </div>
                                    <h4 class="page-title">@yield('page-title', 'Dashboard')</h4>
                                </div>
                            </div>
                        </div>

                        {{-- Main page content --}}
                        @yield('content')

                    </div> <!-- container -->
                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

            <footer class="footer">
                @yield('footer', '© ' . date('Y') . ' Annex by Mannatthemes.')
            </footer>
        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    {{-- Base JS --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('assets/js/detect.js') }}"></script>
    <script src="{{ asset('assets/js/fastclick.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/waves.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/skycons/skycons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>

    {{-- Глобальные страницы-скрипты, если нужны темой --}}
    {{-- Отключай ненужные у дочерних вьюх, или перенеси их туда --}}
    {{-- <script src="{{ asset('assets/pages/dashborad.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/pages/dashboard-itog.js') }}"></script> --}}

    <script src="{{ asset('assets/js/app.js') }}"></script>

    {{-- Weather icons init оставлен, если используется --}}
    <script>
    if (typeof Skycons !== 'undefined'){
        var icons = new Skycons({"color": "#fff"},{"resizeClear": true}),
            list  = ["clear-day","clear-night","partly-cloudy-day","partly-cloudy-night","cloudy","rain","sleet","snow","wind","fog"], i;
        for(i = list.length; i--; ) icons.set(list[i], list[i]);
        icons.play();
    }
    $(function(){
        $("#boxscroll").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true});
        $("#boxscroll2").niceScroll({cursorborder:"",cursorcolor:"#cecece",boxzoom:true});
    });
    </script>

    {{-- Page-level scripts --}}
    @stack('scripts')
</body>
</html>
