<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="User menu">
        <span class="avatar avatar-sm" style="background-color: rgb(63, 81, 181); color: rgb(143, 161, 255);"><span>{{substr(auth()->user()->name, 0,1)}}</span></span>
        <div class="d-none d-xl-block ps-2">
            <div>{{auth()->user()->name}}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" data-bs-popper="static">
        <a href="{{route('admin.users.view', auth()->user()->id)}}" class="dropdown-item">{{trans('admin.menu.profile')}}</a>
        <div class="dropdown-divider"></div>
        <a href="{{route('admin.logout')}}" class="dropdown-item">{{trans('admin.menu.logout')}}</a>
    </div>
</div>
