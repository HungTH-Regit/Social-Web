@extends('layouts.admin.base')

@section('title_page')
  <h1>{{ __('admin.title_page_blog') }}</h1>
@endsection

@section('content')
    <section class="content layout-blogs">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    @if (request()->route()->status == App\Models\Post::STATUS_ALL_BLOG)
                        {{ __('admin.title_all_blog')}} ({{ $dataTotal['totalBlog'] }})
                    @elseif (request()->route()->status == App\Models\Post::STATUS_NOT_APPROVED)
                        {{ __('admin.title_blog_not_approved')}} ({{ $dataTotal['totalBlogNotApproved'] }})
                    @endif
                </h3>
                <div class="card-tools">
                    <form action="{{ route('admin.blog.index', ['status' => request()->route()->status]) }}" method="GET" class='form-search'>
                        <input type="text" name='data' placeholder="{{ __('admin.placeholder_input_search') }}"
                            @if (request()->data) value="{{ request()->data}}" @endif
                        >
                        <button>
                            <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    @if (request()->route()->status == App\Models\Post::STATUS_NOT_APPROVED)
                        <form action="{{ route('admin.blog.approved.all')}}" method="POST" class="form-approved-all">
                            @csrf
                            @method("PUT")
                            <button class="btn btn-primary btn-approved-all">
                                {{ __('admin.btn_approved_all') }}
                            </button>
                        </form>
                    @endif
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0" style="overflow-x:auto;">
                <table border='1px' class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class='col-2'>Image</th>
                            <th class='col-2 header-title'>Title</th>
                            <th class="hide-mobile">Content</th>
                            <th class='header-status'>Status</th>
                            <th class='header-status hide-mobile'>Interactive</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td class='image-blog'>
                                    <img alt="Avatar" class="table-avatar" src="{{ asset('storage/'.$blog->image) }}">
                                </td>
                                <td class='text-table-title'>
                                    {{ Str::limit($blog->title, 30) }}
                                </td>
                                <td class='hide-mobile'>
                                    {{ Str::limit($blog->content, 50) }}...
                                </td>
                                <td class="project-state status-blog">
                                    <form action="{{ route('admin.blog.update.status', ['blog' => $blog]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        @if ($blog->status === App\Models\Post::STATUS_APPROVED)
                                            <button class="btn badge-success btn-sm btn-update-status-blog">
                                                {{ __('admin.btn_approved')}}
                                            </button>    
                                        @else
                                            <button class="btn badge-warning btn-sm btn-update-status-blog" >
                                                {{ __('admin.btn_unapproved')}}
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td class='interactive hide-mobile'>
                                    <p class="total-like">
                                        <i class="fa-solid fa-heart"></i>
                                        {{ $blog->likes()->count() }}
                                    </p>
                                    <p class="total-comment">
                                        <i class="fa-solid fa-comment"></i>
                                        {{ $blog->comments()->count() }}
                                    </p>
                                </td>
                                <td class="options-blog-item">
                                    <form action="{{ route('admin.blog.delete', ['blog' => $blog]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <a target="_blank" class="btn btn-primary btn-sm" href="{{ route('blog.detail', ['blog' => $blog]) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('blog.edit', ['blog' => $blog]) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm icon-delete-blog">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @include('layouts.components.pagination')
            </div>
        </div>
    </section>
@endsection
