@php
$routeName = \Request::route()->getName();
@endphp
<div class="sidebar sidebar-style-2" data-background-color="blue">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset(auth_user('profile'))}}" alt="..." class="avatar-img rounded-circle"
                        style="border:1px solid">
                </div>
                <div class="info">
                    <a href="javascript:;" aria-expanded="true">
                        <span>
                            <span>{{auth_user('name')}}</span>
                            <span class="user-level">{{auth_user('role')}}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{($routeName==='admin.index')?'active':''}}">
                    <a href="{{route('admin.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--Home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @foreach(session('admin_moduls') as $row)
                @if(!$row->sub_menu)
                <li class="nav-item {{(str_contains($routeName,'admin.'.$row->route_prefix))?'active':''}}">
                    <a href="{{route('admin.'.$row->route_prefix.'.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--{{$row->icon}}"></i>
                        <p>{{$row->name}}</p>
                    </a>
                </li>
                @else
                <li class="nav-item {{(str_contains($routeName,'admin.'.$row->route_prefix))?'active':''}}">
                    <a data-toggle="collapse" href="#{{$row->id}}-nav" class="collapsed" aria-expanded="{{ (request()->is($row->path.'*')) ? 'true' : 'false' }}">
                        <i class="ms-Icon ms-Icon--{{$row->icon}}"></i>
                        <p>{{$row->name}}</p>
                        <span class="caret ms-Icon ms-Icon--ChevronDownMed caret-custom-important"></span>
                    </a>
                    <div id="{{$row->id}}-nav" class="collapse {{(str_contains($routeName,'admin.'.$sub->route_prefix))?'show':''}}">
                        <ul class="nav nav-collapse">
                            @foreach($row->sub_menu as $sub)
                            <li class=" {{ (request()->is($sub->path.'*')) ? 'active' : '' }}">
                                <a href="{{route('admin.'.$sub->route_prefix.'.index')}}" class="sidebar-nav-link">
                                    <span class="sub-item">{{$sub->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                @endif
                @endforeach
                @if(isSuperadmin())
                <li class="nav-section">
                    <h4 class="text-section">Superadmin</h4>
                </li>
                <li class="nav-item {{(str_contains($routeName,'admin.cms-users'))?'active':''}}">
                    <a href="{{route('admin.cms-users.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--ManagerSelfService"></i>
                        <p>Users Management</p>
                    </a>
                </li>
                <li class="nav-item {{(str_contains($routeName,'admin.cms-roles'))?'active':''}}">
                    <a href="{{route('admin.cms-roles.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--Fingerprint"></i>
                        <p>Role Management</p>
                    </a>
                </li>
                <li class="nav-item {{(str_contains($routeName,'admin.cms-menus'))?'active':''}}">
                    <a href="{{route('admin.cms-menus.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--OpenFolderHorizontal"></i>
                        <p>Menu Management</p>
                    </a>
                </li>
                <li class="nav-item {{(str_contains($routeName,'admin.cms-moduls'))?'active':''}}">
                    <a href="{{route('admin.cms-moduls.index')}}" class="sidebar-nav-link">
                        <i class="ms-Icon ms-Icon--FabricFormLibrary"></i>
                        <p>Module Generator</p>
                    </a>
                </li>
                @endif
            </ul>

        </div>
    </div>
</div>
