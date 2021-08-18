@extends('app')
@section('content')
    <div class="user-form user-edit" id="userEdit">
        <h2 class="title">ユーザー情報編集ページ</h2>
        <form class="form" method="POST" action="{{ route('user.edit.submit') }}" enctype="multipart/form-data">
            @csrf
            @error('name') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">ユーザー名<span class="red">*</span></label>
                <input class="field" type="text" name="name" value={{ auth()->user()->name }}>
            </div>
            @error('icon_path') <p class="error">{{ $message }}</p> @enderror
            <div class="list choose-img">
                <span class="field-name">プロフィール画像</span>
                <div class="img-field">
                    <label class="img-label" for="iconImg">
                        @if(isset($user_info->icon_path)) <input type="hidden" class="current-icon" name="current_icon_path" value="{{ $user_info->icon_path }}"> @endif
                        <input class="field file" id="iconImg" type="file" name="icon_path" value="">
                        <img class="preview-img" src="@if(empty($user_info->icon_path)) {{ asset('svg/bath-mark-light-blue.svg') }} @else {{ asset(Storage::url($user_info->icon_path) . '?' . $user_info->updated_at->format('YmdHis')) }} @endif" alt="アイコン画像 プレビュー">
                    </label>
                    <a href="" class="dlt-img hide"><span class="btn-text">削除</span></a>
                </div>
            </div>
            @error('prefecture') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">都道府県</label>
                <select class="select" name="prefecture">
                    @if(empty($user_info->prefecture_cd))
                        <option value="" hidden>都道府県を選択してください</option>
                    @endif
                    @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->code }}" @if ($user_info->prefecture_cd == $prefecture->code) selected="selected"@endif>{{ $prefecture->name }}</option>
                    @endforeach
                </select>
            </div>
            @error('introduce') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">自己紹介</label>
                <textarea class="field introduce" type="text" name="introduce">{{ $user_info->introduce }}</textarea>
            </div>
            @error('is_release') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">公開設定<span class="red">*</span></label>
                <div class="field is-release">
                    @foreach($is_release as $release)
                        <label><input type="radio" name=is_release value="{{ $release->code }}" @if($user_info->is_release == $release->code) checked="checked" @endif>{{ $release->name }}</label>
                    @endforeach
                </div>
            </div>
            <button class="btn" type="submit">登録する</button>
        </form>
        <div class="other-links">
            <a href="{{ route('user.change_password.show') }}" class="link @if(isset(auth()->user()->sns_id)) hide @endif">パスワードを変更する</a>
            <a href="{{ route('user.change_email.show') }}" class="link">メールアドレスを変更する</a>
        </div>
    </div>
@endsection
