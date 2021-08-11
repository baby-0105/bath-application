@extends('app')
@section('content')
    <div class="user-form user-edit">
        <h2 class="title">ユーザー情報編集ページ</h2>
        <form class="form" method="POST" action="">
            @csrf
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>ユーザー名</label>
                <input class="input" type="text" name="name" value="{{ old('name') }}">
            </div>
            @error('img')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>プロフィール画像</label>
                <input class="input" type="file" name="img" value="{{ old('img') }}">
            </div>
            @error('prefecture')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list">
                <label>都道府県</label>
                <select class="select" name="prefecture">
                    <option>大阪</option>
                    <option>東京</option>
                </select>
            </div>
            @error('introduce')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="list password-confirm">
                <label>パスワード（確認用）</label>
                <textarea class="input" type="text" name="introduce"></textarea>
            </div>
            @error('pub_or_pri') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label><span class="red">*</span>公開設定</label>
                <div class="input">
                    @if(!empty($post))
                        @foreach($pub_or_pri as $p)
                            <label><input type="radio" name=pub_or_pri value="{{ old($p->code) }}" @if($post->pub_or_pri_cd == $p->code) checked="checked" @endif>{{ $p->name }}</label>
                        @endforeach
                    @elseif(empty($post))
                        <label><input type="radio" name=pub_or_pri value="1" checked="checked">公開</label>
                        <label><input type="radio" name=pub_or_pri value="2">非公開</label>
                    @endif
                </div>
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
        <div class="other-links">
            <a href="{{ route('user.change_password') }}" class="link">パスワードを変更する</a>
            <a href="{{ route('user.change_email') }}" class="link">メールアドレスを変更する</a>
        </div>
    </div>
@endsection
