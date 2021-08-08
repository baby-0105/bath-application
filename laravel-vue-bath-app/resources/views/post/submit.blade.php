@extends('app')
@section('content')
    <div class="post-form post-submit">
        <h2 class="title">投稿</h2>
        <form class="form" method="POST" action="">
            @csrf
            @error('bath_name') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>お風呂名</label>
                <input class="input" type="text" name="bath-name" value="{{ old('bath-name') }}">
            </div>

            @error('eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>全体評価</label>
                <select class="select" name="eval">
                    <option>選択してください</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            @error('hot_water_eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>お湯評価</label>
                <select class="select" name="hot_water_eval">
                    <option>選択してください</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            @error('hall_eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>館内評価</label>
                <select class="select" name="hall_eval">
                    <option>選択してください</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            @error('rock_eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>岩盤浴評価</label>
                <select class="select" name="rock_eval">
                    <option>選択してください</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            @error('sauna_eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>サウナ評価</label>
                <select class="select" name="sauna_eval">
                    <option>選択してください</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            @error('thoughts') <p class="error">{{ $message }}</p> @enderror
            <div class="list password-confirm">
                <label>感想</label>
                <textarea class="input" type="text" name="thoughts"></textarea>
            </div>

            @error('img') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>お風呂画像</label>
                <input class="input" type="file" name="img" value="{{ old('img') }}">
            </div>

            @error('is_release') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label>公開設定</label>
                <div class="input">
                    <label><input type="radio" name="is_release" value="{{ old('is_release') }}" checked>公開</label>
                    <label><input type="radio" name="is_release" value="{{ old('is_release') }}">非公開</label>
                </div>
            </div>
            <input class="btn" type="submit" value="登録する">
        </form>
    </div>
@endsection
