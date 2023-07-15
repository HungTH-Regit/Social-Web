@extends('layouts.authentication.base') 

@section('content')
    <form method="POST" action="{{ route('post.register') }}" class="form-auth form-auth-register">
        @csrf
        <a href="{{ route('blogs.home') }}" class="form-auth-logo">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="">
            <h4>{{ __('app.name_website') }}</h4>
        </a>
        <div class="form-auth-title">
            <p>{{ __('auth.title_form_register') }}</p>
        </div>
        <div class="form-auth-input">
            <label for="username">Username<span>*</span></label>
            <input type="text" id="username" name="username" value="{{ old('username') }}">
            @error ('username')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="form-auth-input">
            <label for="email">Email<span>*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            @error ('email')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="form-auth-input">
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" class="input-password" name="password">
            @error ('password')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="form-auth-input">
            <label for="password-confirm">Password Confirm<span>*</span></label>
            <input type="password" id="password-confirm" class="input-password-confirm" name="password_confirmation">
        </div>
        <div class="form-auth-btn form-register">
            <button type="submit">{{ __('auth.btn_register') }}</button>
            <a href="{{ route('view.login') }}">{{ __('auth.text_login') }}</a>
        </div>
    </form>
@endsection
