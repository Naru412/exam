@extends('layouts.app')

@section('css')
<link href="{{asset('/css/auth.css')}}" rel="stylesheet" >
@endsection

@section('login-button')
<a href="{{ route('login') }}" class="header__btn">login</a>
@endsection

@section('content')
<div class="auth-container">
    <h2 class="auth__title">Register</h2>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group">
            <label>お名前</lavel>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="from-group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
            <p class="error">{{ $message }}</P>
            @enderror
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106">
            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror
            <input type="password" name="password_confirmation" placeholder="確認用パスワード">
        </div>

        <button type="submit" class="auth-button">登録</button>
    </form>
</div>
@endsection
