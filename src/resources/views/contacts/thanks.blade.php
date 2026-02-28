@extends('layouts.app')

@section('css')
<link href="{{asset('/css/thanks.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="container">
    <h2 class="thanks__title">お問い合わせありがとうございました</h2>
    <p>内容を受け付けました。担当者よりご連絡いたします。</p>

    <a href="{{ url('/') }}" class="home-button">
        HOME
    </a>
</div>
@endsection
   
