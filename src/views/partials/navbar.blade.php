@php
    $totalNotification = cmsNotification()->where('is_read',0)->count();
    $listNotification = cmsNotification()->where('is_read',0)->limit(5)->get();
@endphp
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg">
    <div class="container-fluid">
        <div class="collapse" id="search-nav" style="max-width:unset">
            <h1>
                <span>{{(isset($title)?$title:'Dashboard')}}</span>
            </h1>
            <span class="garis-line"></span>
            <span class="sub-name">
                <span>
                    @if(isset($pagetype))
                        {{$pagetype}}
                    @else
                        @if(request()->is('*/add*'))
                            Tambah
                        @elseif(request()->is('*/edit/*'))
                            Edit
                        @else
                            List
                        @endif
                    @endif
                </span>
            </span>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret" s>
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="notification">
                        <span class="totalNotification">{{$totalNotification}}</span>
                    </span>
                </a>
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">
                            @if(count($listNotification))
                            You have {{$totalNotification}} notification
                            @else
                            You don't have notification
                            @endif
                        </div>
                    </li>
                    <div class="listNotificationAdmin">
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @foreach($listNotification as $not)
                                    <a href="{{route('admin.cms-notification.read',$not->id)}}">
                                        <div class="notif-content">
                                            <span class="block">{{$not->description}}</span>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </div>
                    <li>
                        <a class="see-all" href="{{route('admin.cms-notification.index')}}">See all notifications<i
                                class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="{{asset(auth_user('profile'))}}" alt="..." class="avatar-img rounded-circle"
                            style="border:1px solid #ddd">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg">
                                    <img src="{{asset(auth_user('profile'))}}" alt="image profile"
                                        class="avatar-img rounded"></div>
                                <div class="u-text">
                                    <h4>{{auth_user('name')}}</h4>
                                    <p class="text-muted">{{auth_user('email')}}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.profile')}}">
                                Account Setting
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;" onclick="confirmLogout()">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>