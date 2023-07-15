@extends('layouts.authentication.base')

@section('content')
    <form action="{{ route('post.forgot.password') }}" method="POST" class='form-auth'>
        @csrf
        <div class="form-auth-logo">
            <img src="{{ Vite::asset('resources/images/LogoRegit.png') }}" alt="">
            <h4>RT-Blogs</h4>
        </div>
        <div class="form-auth-title">
            <p>Forgot Password</p>
        </div>
        <div class="form-auth-input">
            <label for="email">Input your email:</label>
            <input type="email" required id="email" name="email">
            @error ('email')
                <small>{{ $message }}</small>
            @enderror
        </div>
        <div class="form-auth-btn">
            <button type="submit">Send</button>
            <a href="{{ route('view.login') }}">Back to login Page</a>
        </div>
    </form>
@endsection
