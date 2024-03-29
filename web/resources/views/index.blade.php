<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stories</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('/vendors/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/themify-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/selectFX/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <script src="https://cdn.firebase.com/libs/firebaseui/4.0.0/firebaseui.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.firebase.com/libs/firebaseui/4.0.0/firebaseui.css" />
    <script src="https://www.gstatic.com/firebasejs/7.1.0/firebase.js"></script>
    <link href="{{ asset('/font-awesome/js/fontawesome.js') }}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/js/solid.js') }}" rel="stylesheet">
    <!-- <link href="{{ asset('/font-awesome/js/brands.js') }}" rel="stylesheet"> -->

    <!-- chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" charset="utf-8"></script>
    @yield('css')
</head>

<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li {!! (Request::is('admin') ? ' class="active"' : '') !!}>
                        <a href="{{ route('admin.index') }}" > <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    @if(Auth::user()->role_id == ADMIN)
                    <li {!! (Request::is('admin/user') || Request::is('admin/user/*') ? ' class="active"' : '') !!}>
                        <a href="{{ route('user.index') }}"> <i class='menu-icon fa fa-users'></i></i>User</a>
                    </li>
                    @endif
                    <li {!! (Request::is('admin/category') || Request::is('admin/category/*') ? ' class="active"' : '') !!}>
                        <a href="{{ route('category.index') }}"> <i class='menu-icon fa fa-th-list'></i></i>Category </a>
                    </li>
                    <li {!! (Request::is('admin/age') || Request::is('admin/age/*') ? ' class="active"' : '') !!}>
                        <a href="{{ route('age.index') }}"> <i class="menu-icon fa fa-calendar"></i>Ages </a>
                    </li>
                    <li {!! (Request::is('admin/story') || Request::is('admin/story/*') ? ' class="active"' : '') !!}>
                        <a href="{{ route('story.index') }}"> <i class='menu-icon fa fa-book'></i>Story </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <div class="row">
                          <div class="col" style="margin-top: auto;padding-right: 0px;font-weight: 500;">
                               {{Auth::user()->name}}
                          </div>
                           <div class="col" style="padding-left: 5px;">
                               <img class="user-avatar rounded-circle" src="{{ asset('/images/admin.jpg') }}" alt="User Avatar">
                           </div>
                       </div>
                       
                       
                   </a>

                   <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('profile') }}"><i class="fa fa-user"></i> My Profile</a>
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>

</header><!-- /header -->
<!-- Header-->

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">

    @yield('content')
</div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->
<script src="{{ asset('/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>


<script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/init-scripts/data-table/datatables-init.js') }}"></script>

<script src="{{ asset('/vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
<script src="{{ asset('/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
<script>
    (function($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>
@yield('js')

</body>

</html>
