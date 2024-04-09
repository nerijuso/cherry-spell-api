<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
        <span class="avatar avatar-sm" style="background-color: rgb(63, 81, 181); color: rgb(143, 161, 255);"><span>{{substr(auth()->user()->name, 0,1)}}</span></span>
        <div class="d-none d-xl-block ps-2">
            <div>{{auth()->user()->name}}</div>
        </div>
    </a>
</div>
