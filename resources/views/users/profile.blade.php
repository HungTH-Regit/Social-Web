@extends('layouts.user.app')

@section('content')
    <div class="layout-profile">
        <form method="POST" action="{{ route('user.update', ['user' => $profile]) }}" enctype="multipart/form-data" class="my-profile">
            @csrf
            @method("PUT")
            <div class="avatar-user">
                <input type='file' name="avatar" class="upload-avatar-user" hidden>
                <img class="image-preview" src="{{ asset('storage/'.$profile->avatar) }}" alt="">
            </div>
            <div class="btn btn-upload">{{ __('user.btn_update_avatar') }}</div>
            <div class="info-user">
                <div class="item-info">
                    <strong>{{ __('user.text_username') }}</strong>
                    <p class="text-user-name">{{ $profile->user_name }}</p>
                    <input type="text" class="input-user-name" name="user_name" value="{{ $profile->user_name }}">
                </div>
                <div class="item-info">
                    <strong>{{ __('user.text_email') }}</strong>
                    <p>{{ $profile->email }}</p>
                </div>
            </div>
            <div class="btn btn-edit-profile">{{ __('user.btn_edit_profile') }}</div>
            <button class="btn btn-save">{{ __('user.btn_save') }}</button>
        </form>
        <div class="my-blog">
            @if ($profile->blogs->count() > 0)
                <h2 class="title">{{ __('user.title_my_blog') }}</h2>
                <div class="all-blog">
                    @foreach ($profile->blogs as $index => $item)
                        @if ($index == 5)
                            <a href="{{ route('user.blog') }}" class="arrow-right item-blog">
                                <i class="fa-sharp fa-solid fa-arrow-right"></i>
                                <p>See All Blog</p>
                            </a>
                            @break
                        @endif
                        <a href="{{ route('blog.detail', ['blog'=> $item]) }}" class="item-blog">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="">
                            <div class="info-blog">
                                <h2>{{ $item->title }}</h2>
                                <p>{{ Str::limit($item->content, 255) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <h2 class="title-no-blog">{{ __('blog.text_no_blog') }}</h2>
            @endif
        </div>
    </div>
    @vite(['resources/js/user.js'])
@endsection
