@extends('layouts.authentication.base') 

@section('content')
    <form method="POST" action="{{ route('user.password.update') }}" class="form-auth form-auth-register">
        @csrf
        @method("PUT")
        <a href="{{ route('blogs.home') }}" class="form-auth-logo">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="">
            <h4>{{ __('app.name_website') }}</h4>
        </a>
        <div class="form-auth-title">
            <p>{{ __('auth.title_change_password') }}</p>
        </div>
        <div class="form-auth-input">
            <label for="password-current">Password Current<span>*</span></label>
            <input type="password" id="password-current" name="password_current">
            @error ('password_current')
                <small>{{ $message }}</small>
            @enderror
            @if (session('error'))
                <small>{{ session('error') }}</small>
            @endif
        </div>
        <div class="form-auth-input">
            <label for="password-new">Password New<span>*</span></label>
            <input type="password" id="password-new" name="password">
            @error ('password')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="form-auth-input">
            <label for="password-confirm">Password Confirm<span>*</span></label>
            <input type="password" id="password-confirm" class="input-password-confirm" name="password_confirmation">
        </div>
        <div class="form-auth-btn form-register">
            <button type="submit">{{ __('auth.btn_change_password') }}</button>
            <a href="{{ route('blogs.home') }}">{{ __('app.text_back_to_home') }}</a>
        </div>
    </form>
@endsection
