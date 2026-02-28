@extends('layouts.app')

@section('css')
<link href="{{asset('/css/admin.css')}}" rel="stylesheet" >
@endsection

@section('logout-button')
<form method="POST" action="/logout">
    @csrf
    <button>logout</button>
</form>
@endsection

@section('content')
<div class="admin-container">
    <h2 class="admin-title">Admin</h2>
    <form method="GET" action="/admin" class="search-area">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

        <select name="gender">
            <option value="">性別</option>
            <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>全て</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ request('category_id') == 2 ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{ request('category_id') == 3 ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ request('category_id') == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ request('category_id') == 5 ? 'selected' : '' }}>その他</option>
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button class="search-btn" type="submit">検索</button>
        <a href="/admin" class="reset-btn">リセット</a>
    </form>

    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">
    エクスポート
    </a>

    <div class="pagination">
    {{ $contacts->links('pagination::bootstrap-4') }}
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td>
                    @if($contact->gender == 1)
                        男性
                    @elseif($contact->gender == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td><button class="detail-btn" 
                type="button" 
                data-id="{{ $contact->id }}"
                data-name="{{ $contact->last_name }} {{ $contact->first_name }}" 
                data-gender="{{ $contact->gender }}"
                data-email="{{ $contact->email }}" 
                data-tel="{{ $contact->tel }}"
                data-address="{{ $contact->address }}"
                data-building="{{ $contact->building }}"
                data-category="{{ $contact->category->content }}"
                data-detail="{{ $contact->detail }}"
                >詳細</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modal" class="modal">
    <div class="modal-inner">
        <button id="close-btn" class="close-btn"></button>

        <h3>お問い合わせ詳細</h3>

        <p>お名前：<span id="modal-name"></span></p>
        <p>性別：<span id="modal-gender"></span></p>
        <p>メール：<span id="modal-email"></span></p>
        <p>電話番号：<span id="modal-tel"></span></p>
        <p>住所：<span id="modal-address"></span></p>
        <p>建物名：<span id="modal-building"></span></p>
        <p>お問い合わせの種類：<span id="modal-category"></span></p>
        <p>お問い合わせ内容：</p>
        <p id="modal-detail"></p>

        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn"
                onclick="return confirm('本当に削除しますか？')">
                削除
            </button>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById('modal');
const detailButtons = document.querySelectorAll('.detail-btn');
const closeBtn = document.getElementById('close-btn');

const deleteForm = document.getElementById('delete-form');


detailButtons.forEach(button => {
    button.addEventListener('click', () => {

        let genderText = '';
        if (button.dataset.gender == 1) {
            genderText = '男性';
        } else if (button.dataset.gender == 2) {
            genderText = '女性';
        } else {
            genderText = 'その他';
        }

        document.getElementById('modal-name').textContent = button.dataset.name;
        document.getElementById('modal-gender').textContent = genderText;
        document.getElementById('modal-email').textContent = button.dataset.email;
        document.getElementById('modal-tel').textContent = button.dataset.tel;
        document.getElementById('modal-address').textContent = button.dataset.address;
        document.getElementById('modal-building').textContent = button.dataset.building;
        document.getElementById('modal-category').textContent = button.dataset.category;
        document.getElementById('modal-detail').textContent = button.dataset.detail;

        deleteForm.action = '/admin/' + button.dataset.id;

        modal.style.display = 'block';
    });
});

closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});
</script>
@endsection


