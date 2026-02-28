@extends('layouts.app')

@section('css')
<link href="{{asset('/css/auth.css')}}" rel="stylesheet" >
@endsection

@section('register-button')
<a href="{{ route('register') }}" class="header__btn">register</a>
@endsection

@section('content')
<div class="auth__container">
    <h2 class="auth-title">Login</h2>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
            <p class="error">
                @if($message === 'The email must be a valid email address.')
                    メールアドレスはメール形式で入力してください
                @else
                    メールアドレスを入力してください
                @endif   
            </p>
            @enderror
        </div>

        <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" placeholder="例: coachtech1106">
            @error('password')
            <p class="error">パスワードを入力してください</p>
            @enderror

            @if(session('error'))
            <p class="error">{{ session('error') }}</p>
            @endif
        </div>

        <button type="submit" class="auth-button">ログイン</button>
    </form>
</div>
@endsection
