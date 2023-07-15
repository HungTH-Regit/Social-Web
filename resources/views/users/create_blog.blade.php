@extends('layouts.user.app')

@section('content')
    <div class="layout-create">
        <div class="dashboard">
            <a href="{{ route('blogs.home') }}">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <p>{{ __('blog.title_create_blog') }}</p>
        </div>
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>{{ __('blog.title_create_blog') }}</h3>
            <div class="form-item">
                <label for="select_category">Category<span>*</span></label>
                <select type="text" id="select_category" name="category_id" class="item-input">
                    <option value="">{{ __('blog.title_select_category')}}</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                </select>
                @error ('category_id')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-item item-title">
                <label for="title">Title<span>*</span></label>
                @error ('title')
                    <small>{{ $message }}</small>
                @enderror
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="item-input title" placeholder="Title">
            </div>
            <div class="form-item">
                <label for="image">{{ __('blog.btn_upload_img') }}<span>*</span></label>
                @error ('image')
                    <small>{{ $message }}</small>
                @enderror
                <div class="item-input btn-primary btn-upload-img">{{ __('blog.btn_upload_img') }}</div>
                <input type="file"  name="image" id="image" class="upload-image-blog" hidden>
            </div>
            <div class="img-preview">
                <img src="" alt="">
            </div>
            <div class="form-item">
                <label for="description">Description<span>*</span></label>
                @error ('content')
                    <small>{{ $message }}</small>
                @enderror
                <textarea name="content" id="description" class="item-input" cols="30" rows="10" placeholder="Description">{{ old('content') }}</textarea>
            </div>
            <button type='submit'>{{ __('blog.btn_create_blog') }}</button>
        </form>
    </div>
@endsection
