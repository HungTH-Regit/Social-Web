@extends('layouts.authentication.base')

@section('content')
    <form method="POST" action="{{ route('post.login') }}" class="form-auth form-auth-login">
        @csrf
        <a href="{{ route('blogs.home') }}" class="form-auth-logo">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="">
            <h4>RT-Blogs</h4>
        </a>
        <div class="form-auth-title">
            <p>{{ __('auth.title_form_login') }}</p>
        </div>
        <div class="form-auth-input">
            <label for="email">Username or email<span>*</span></label>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="form-auth-input">
            <label for="password">Password<span>*</span></label>
            <input type="password" id="password" class="input-password" name="password">
            @if (session('message'))
                <span class="notify-error">{{ session('message') }}</span>
            @endif
            @if (session('success'))
                <span class='notify-success'>{{ session('success') }}</span>
            @endif
            @error ('email')
                <br><span class="notify-error">{{ $message }}</span>
            @enderror
            @error ('password')
                <br><span class="notify-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-auth-password">
            <div class="remember-password">
                <div class="checkbox-remember">
                    <input type="checkbox" name="remember">
                </div>
                <p>Remember password</p>
            </div>
            <a href="{{ route('view.forgot.password') }}">Forgot your password?</a>
        </div>
        <div class="form-auth-btn">
            <button type="submit">{{ __('auth.btn_login') }}</button>
            <a href="{{ route('view.register') }}">{{ __('auth.text_register') }}</a>
        </div>
    </form>
@endsection
