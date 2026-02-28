@extends('layouts.app')

@section('css')
<link href="{{asset('/css/confirm.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>

    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $inputs['gender'] }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $inputs['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $inputs['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $inputs['building'] }}</td>
        </tr>
        <tr>
            <th>問い合わせの種類</th>
            <td>{{ $inputs['category_id'] }}</td>
        </tr>
        <tr>
            <th>問い合わせ内容</th>
            <td>{{ $inputs['detail'] }}</td>
        </tr>
    </table>

    <form action="{{ route('contacts.store') }}" method="post">
        @csrf
        @foreach($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm__left-button">
            <button type="submit">送信</button>
        </div>
    </form>

    <form action="{{ route('contacts.create') }}" method="post">
        @csrf
        @foreach($inputs as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm__rigthl-button">
            <button type="button" onclick="history.back()">修正</button>
        </div>
    </form>
@endsection

