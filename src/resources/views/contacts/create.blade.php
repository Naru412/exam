@extends('layouts.app')

@section('css')
<link href="{{asset('/css/create.css')}}" rel="stylesheet" >
@endsection

@section('content')
<div class="contact">
    <h2 class="contact__title">Contact</h2>
        <form action="{{ route('contacts.confirm') }}" method="POST" class="contact-form">
            @csrf
            <div class="form-group">
                <div class="form-label">
                    <label>お名前</label>
                </div>
                <div class="form-input">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例:山田">
                    @error('last_name')
                    <p class="error">{{ $message }}</p>
                    @enderror

                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例:太郎">
                    @error('first_name')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>性別</label>
                </div>
                <div class="form-input">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他</label>
                    @error('gender')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>メールアドレス</label>
                </div>
                <div class="form-input">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例:test@example.com">
                    @error('email')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label>電話番号</label>
                <div class="form-input tel-input">
                    @foreach (['tel1','tel2','tel3'] as $tel)
                        <input type="text" name="{{ $tel }}" value="{{ old($tel) }}" maxlength="4">
                        @error($tel)
                            <span class="error">{{ $message }}</span>
                        @enderror
                        @if (!$loop->last)
                            <span>-</span>
                        @endif
                    @endforeach   
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-label">
                    <label>住所</label>
                </div>
                <div class="form-input">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3">
                    @error('address')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>建物名</label>
                </div>
                <div class="form-input">
                     <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101">
                </div>
            </div>
                
            <div class="form-group">
                <div class="form-label">
                    <label>お問い合わせの種類</label>
                </div>
                <div class="form-input">
                    <select name="category_id">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-label">
                    <label>お問い合わせ内容</label>
                </div>
                <div class="form-input">
                    <textarea name="detail" rows="5">{{ old('detail') }}</textarea>
                    @error('detail')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-button">
                <button type="submit">確認画面</button>
            </div>
        </form>
</div>
@endsection

    
                        
                        
                        