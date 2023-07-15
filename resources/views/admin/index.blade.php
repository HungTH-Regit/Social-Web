@extends('layouts.admin.base')

@section('title_page')
  <h1>{{ __('admin.title_page_dashboard') }}</h1>
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ __('app.name_website') }}</h3>
              <p>{{ __('admin.content_header_home') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('blogs.home') }}" class="small-box-footer"
              >{{ __('admin.text_more_info') }} <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $dataTotal['totalUser'] }}</h3>
              <p>{{ __('admin.title_page_user') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.user.index') }}" class="small-box-footer"
              >{{ __('admin.text_more_info') }} <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $dataTotal['totalBlog'] }}</h3>
              <p>{{ __('admin.title_page_blog') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.blog.index', ['status' => App\Models\Post::STATUS_ALL_BLOG]) }}" class="small-box-footer"
              >{{ __('admin.text_more_info') }} <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $dataTotal['totalBlogNotApproved'] }}</h3>
              <p>{{ __('admin.title_blog_not_approved') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.blog.index', ['status' => App\Models\Post::STATUS_NOT_APPROVED]) }}" class="small-box-footer"
              >{{ __('admin.text_more_info') }} <i class="fas fa-arrow-circle-right"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
