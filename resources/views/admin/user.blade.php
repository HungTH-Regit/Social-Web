@extends('layouts.admin.base')

@section('title_page')
  <h1>{{ __('admin.title_page_user') }}</h1>
@endsection

@section('content')
  <section class="content layout-users">
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row">
          @foreach ($users as $user)
            <div class="item-user col-12 col-sm-12 col-md-6 col-lg-4  d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  {{ __('admin.title_item_user') }}
                </div>
                <div class="card-body pt-0">
                  <div class="row box-info-user">
                    <div class="col-3 text-center avatar-user">
                      <img src="{{ asset('storage/'.$user->avatar) }}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    <div class="col-9 info">
                      <h2 class="lead user-name"><b>{{ $user->user_name }}</b></h2>
                      <div class="item-info">
                        <i class="fa-solid fa-envelope"></i>
                        <p>{{ $user->email }}</p>
                      </div>
                      <div class="item-info">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <p>{{ $user->created_at }}</p>
                      </div>
                      <div class="item-info status-user">
                        @if ($user->status === App\Models\User::STATUS_ACTIVE)
                          <i class="fa-solid fa-user-check"></i>{{ __('admin.text_user_active')}}
                        @else 
                          <i class="fa-solid fa-user-xmark"></i>{{ __('admin.text_user_inactive')}}
                        @endif
                      </div>
                      <div class="item-info">
                        <i class="fa-solid fa-blog"></i>
                        <p>{{ $user->blogs()->count() }} Blog</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <form action="{{ route('admin.user.delete', ['user' => $user]) }}" method="POST" class="card-footer-option text-right">
                    @csrf
                    @method("DELETE")
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.user.profile', ['user' => $user]) }}">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.user.profile', ['user' => $user]) }}">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <button class="btn btn-danger btn-sm">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <ul class="paginate">
      <ul class="paginate">
        @if ($users->lastPage() > 1)
            <li class="arrow-paginate">
                <a href="{{ $users->previousPageUrl() }}" rel="prev">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            </li>
            <li class="{{ ($users->currentPage() == 1) ? ' paginate-active' : '' }}">
                <a href="{{ $users->url($users->onFirstPage()) }}">1</a>
            </li>
            <?php
                $start = $users->currentPage() - 2;
                $end = $users->currentPage() + 2;
                if ($start < 1) {
                    $start = 1;
                    $end += 1;
                } 
                if ($end >= $users->lastPage()) {
                    $end = $users->lastPage();
                }
            ?>
            @if ($users->currentPage() > 3)
                <li><span>...</span></li>
            @endif
            @for ($i = $start + 1; $i < $end; $i++)
                    <li class="{{ ($users->currentPage() == $i) ? ' paginate-active' : '' }}">
                        <a href="{{ $users->url($i) }}">{{$i}}</a>
                    </li>
            @endfor
            @if ($users->currentPage()+2 < $users->lastPage())
                <li><span>...</span></li>
            @endif
            <li class="{{ ($users->currentPage() == $users->lastPage()) ? ' paginate-active' : '' }}">
                <a href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a>
            </li>
            <li class="arrow-paginate">
                <a href="{{ $users->nextPageUrl() }}" rel="next">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </li>
        @endif
    </ul>
  </section>
@endsection
