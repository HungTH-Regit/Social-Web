@extends('layouts.user.app')

@section('content')
    <div class="layout-update">
        <div class="dashboard">
            <a href="{{ route('blogs.home') }}">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <p>{{ __('blog.title_update_blog') }}</p>
        </div>
        <form action="{{ route('blog.update', ['blog' => $blog]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <h3>{{ __('blog.title_update_blog') }}</h3>
            <div class="form-item">
                <label for="select_category">Category<span>*</span></label>
                <select type="text" id="select_category" name="category_id" class="item-input">
                    @foreach ($categories as $item)
                    @if (isset($categorySelected))
                        @if ($item['id'] == $categorySelected)
                            <option selected value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @else
                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                        @endif
                    @else
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endif
                @endforeach
                </select>
            </div>
            <div class="form-item">
                <label for="title">Title<span>*</span></label>
                @error ('title')
                    <small>{{ $message }}</small>
                @enderror
                <input type="text" id="title" name="title" value="{{ $blog->title }}" class="item-input title" placeholder="Title">
            </div>
            <div class="form-item">
                <label for="image">{{ __('blog.btn_change_img') }}<span>*</span></label>
                @error ('image')
                    <small>{{ $message }}</small>
                @enderror
                <div class="item-input btn-primary btn-upload-img">{{ __('blog.btn_change_img') }}</div>
                <input type='file' name="image" id="image" class="upload-image-blog" hidden>
            </div>
            <div class="img-preview">
                <img src="{{ asset('storage/'.$blog->image) }}" alt="">
            </div>
            <div class="form-item">
                <label for="description">Description<span>*</span></label>
                @error ('content')
                    <small>{{ $message }}</small>
                @enderror
                <textarea name="content" value="" id="description" class="item-input" cols="30" rows="10" placeholder="Description">{{ $blog->content }}</textarea>
            </div>
            <button type='submit'>{{ __('blog.btn_update_blog') }}</button>
        </form>
    </div>
@endsection
