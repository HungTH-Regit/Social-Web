<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/png" href="{{ Vite::asset('resources/images/LogoRegit.png') }}"/>
    <title>{{ __('app.name_website') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ Vite::asset('resources/css/adminlte.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="{{ Vite::asset('resources/js/adminlte.js') }}"></script>
    @vite(['resources/scss/admin.scss'])
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('blogs.home') }}" class="brand-link">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8"/>
            <span class="brand-text font-weight-light">{{ __('app.name_website') }}</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('storage/'.Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image" />
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->user_name }}</a>
                </div>
            </div>
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
                <li class="nav-item">
                  <a href="{{ route('admin.dashboard') }}" 
                    class="nav-link @if (Route::is('admin.dashboard')) active @endif" 
                  >
                    <i class="fa-solid fa-house"></i>
                    <p>{{ __('admin.navbar_dashboard') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.user.index') }}" 
                    class="nav-link @if (Route::is('admin.user.index')) active @endif" 
                  >
                    <i class="fa-solid fa-users"></i>
                    <p>{{ __('admin.navbar_user') }}</p>
                  </a>
                </li>
                <li class="nav-item 
                  @if (Route::is('admin.blog.index') || Route::is('admin.blog.not.approved')) 
                    menu-is-opening menu-open
                  @endif
                 ">
                  <a href="{{ route('admin.blog.index', ['status' =>  App\Models\Post::STATUS_ALL_BLOG]) }}" 
                    class="nav-link @if (Route::is('admin.blog.index')) active @endif" 
                  >
                    <i class="fa-solid fa-blog"></i>
                    <p>{{ __('admin.navbar_blog') }}</p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('admin.blog.index', ['status' =>  App\Models\Post::STATUS_ALL_BLOG]) }}"
                        @if (request()->route()->status == App\Models\Post::STATUS_ALL_BLOG)
                          class ="nav-link active"
                        @else
                          class="nav-link"
                        @endif
                      >
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('admin.navbar_all_blog') }}</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('admin.blog.index', ['status' =>  App\Models\Post::STATUS_NOT_APPROVED]) }}"
                        @if (request()->route()->status == App\Models\Post::STATUS_NOT_APPROVED)
                          class ="nav-link active"
                        @else
                          class="nav-link"
                        @endif
                      >
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ __('admin.navbar_blogs_not_approved') }}</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <form method="POST" action="{{ route('logout') }}" class="nav-link">
                    @csrf
                    <button>
                      <i class="fa-solid fa-right-from-bracket"></i>
                      <p>{{ __('admin.navbar_logout') }}</p>
                    </button>
                  </form>
              </li>
              </ul>
            </nav>
        </div>
      </aside>
      <div class="content-wrapper">
        <div class="notification">
          @include('layouts.components.notification')
        </div>
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                @yield('title_page')
              </div>
            </div>
          </div>
        </section>
        @yield("content")
      </div>
    </div>
  </body>
</html>
