<!DOCTYPE html>
<html lang="en">

<head>
    @include('starterkit::partials.head')
    @stack('css')
</head>

<body class="ms-Fabric">
    <div class="wrapper fullheight-side">
       
        <!-- Logo Header -->
        <div class="logo-header position-fixed" data-background-color="blue">
            <a href="{{url('')}}" class="logo">
                <img src="{{asset(s_config('app_logo'))}}" alt="navbar brand" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->
        <!-- Sidebar -->
        @include('starterkit::partials.sidebar')
        <!-- End Sidebar -->

        <!-- Navbar Header -->
        @include('starterkit::partials.navbar')
        <!-- End Navbar -->

        <div class="main-panel full-height">
            <!-- Content -->
            @if($errors->all() || session('error_message') || session('success_message'))
            <div class="col-sm-12 mt-3">
                @if($errors->all())
                <div class="alert alert-warning mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(session('success_message'))
                <div class="alert alert-success mb-0">
                    <span>{{session('success_message')}}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>
            @endif
            {{$slot}}
        </div>
    </div>



    @include('starterkit::partials.script')
    @stack('js')

</body>

</html>
