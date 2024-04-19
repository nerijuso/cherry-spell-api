<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{route('admin.welcome')}}">
                {{config('app.name')}}
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.welcome')}}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                        </span>
                        <span class="nav-link-title">
                             {{ trans('admin.aside.home') }}
                      </span>
                    </a>
                </li>
                <li class="nav-item @if(preg_match('/^admin.users/', Route::currentRouteName())) active @endif">
                    <a class="nav-link" href="{{route('admin.users')}}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-square" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M9 10a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                               <path d="M6 21v-1a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v1"></path>
                               <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                             {{ trans('admin.aside.users') }}
                      </span>
                    </a>
                </li>
                <li class="nav-item dropdown @if(preg_match('/^admin.leads/', Route::currentRouteName())) active @endif">
                    <a class="nav-link" href="{{route('admin.leads')}}" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-dollar"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3" /><path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M19 21v1m0 -8v1" /></svg>                        <span class="nav-link-title">
                            {{ trans('admin.aside.leads') }}
                      </span>
                    </a>
                </li>
                <li class="nav-item dropdown @if(preg_match('/^admin.app_questions/', Route::currentRouteName())) active @endif">
                    <a class="nav-link" href="{{route('admin.app_questions')}}" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-folder-question"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 19h-10a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2.5" /><path d="M19 22v.01" /><path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>
                        <span class="nav-link-title">
                            {{ trans('admin.aside.app_questions') }}
                      </span>
                    </a>
                </li>
                <li class="nav-item dropdown @if(preg_match('/^admin.quizzes/', Route::currentRouteName()) || preg_match('/^admin.funnels/', Route::currentRouteName())) active @endif">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-filter"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>
                        <span class="nav-link-title">
                            {{ trans('admin.aside.funnels') }}
                      </span>
                    </a>
                    <div class="dropdown-menu @if(preg_match('/^admin.quizzes/', Route::currentRouteName()) || preg_match('/^admin.funnels/', Route::currentRouteName())) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{route('admin.funnels')}}">
                                    {{ trans('admin.aside.funnels') }}
                                </a>
                                <a class="dropdown-item" href="{{route('admin.quizzes')}}">
                                    {{ trans('admin.aside.quizzes') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown @if(preg_match('/^admin.subscriptions/', Route::currentRouteName())) active @endif">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true" >
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-businessplan"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" /><path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M5 15v1m0 -8v1" /></svg>                        <span class="nav-link-title">
                            {{ trans('admin.aside.subscriptions') }}
                      </span>
                    </a>
                    <div class="dropdown-menu @if(preg_match('/^admin.subscriptions/', Route::currentRouteName())) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="{{route('admin.subscriptions.plans')}}">
                                    {{ trans('admin.aside.plans') }}
                                </a>
                                <a class="dropdown-item" href="{{route('admin.subscriptions')}}">
                                    {{ trans('admin.aside.subscriptions') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown @if(preg_match('/^admin.system/', Route::currentRouteName())) active @endif">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="true">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-cog" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M12.003 21c-.732 .001 -1.465 -.438 -1.678 -1.317a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c.886 .215 1.325 .957 1.318 1.694"></path>
                           <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                           <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                           <path d="M19.001 15.5v1.5"></path>
                           <path d="M19.001 21v1.5"></path>
                           <path d="M22.032 17.25l-1.299 .75"></path>
                           <path d="M17.27 20l-1.3 .75"></path>
                           <path d="M15.97 17.25l1.3 .75"></path>
                           <path d="M20.733 20l1.3 .75"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            System
                      </span>
                    </a>
                    <div class="dropdown-menu @if(preg_match('/^admin.system/', Route::currentRouteName())) show @endif">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item" href="/{{config('horizon.path')}}">
                                    {{trans('admin.aside.horizon')}}
                                </a>
                                <a class="dropdown-item" target="_blank" rel="nofollow noopener" href="{{route('admin.adminer')}}">
                                    {{trans('admin.aside.adminer')}}
                                </a>
                                <a class="dropdown-item" href="{{route('admin.mail_templates.index')}}">
                                    {{trans('admin.aside.transactional_email')}}
                                </a>
                                <a class="dropdown-item" href="{{route('admin.system.file_manager')}}">
                                    {{trans('admin.aside.file_manager')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</aside>
