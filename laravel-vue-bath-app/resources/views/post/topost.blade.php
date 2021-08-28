@extends('app')
@section('content')
    <div class="popup @if(session('isUpdatePost')) flex @else hide @endif" id="popup">
        <div class="content">
            <p class="text">選択したお風呂は、以前に投稿しています。</p>
            <p class="text">{{ session('isUpdatePost') }}</p>
            <form method="POST" action="{{ route('post.update') }}">
                @csrf
                <input type="hidden" name="">
                <button>更新する</button>
                <button class="close" id="close">閉じる</button>
            </form>
        </div>
    </div>
    <div class="post-form post-topost" id="toPost">
        <h2 class="title">投稿</h2>
        <form class="form" method="POST" action="{{ route('post.submit') }}" enctype="multipart/form-data">
            @csrf
            @error('title') <p class="error">{{ $message }}</p> @enderror
            <to-post v-bind:prefectures="{{ $prefectures }}"></to-post> {{-- Vue:お風呂検索コンポーネント --}}
            @error('eval') <p class="error">{{ $message }}</p> @enderror
            @error('hot_water_eval') <p class="error">{{ $message }}</p> @enderror
            @error('rock_eval') <p class="error">{{ $message }}</p> @enderror
            @error('sauna_eval') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">評価<span class="red">*</span></label>
                <div class="select-area">
                    <select class="eval" name="eval">
                        <option value="" hidden>全体評価*</option>
                        @foreach ($evals as $eval)
                            <option value="{{ $eval->code }}">{{ $eval->name }}</option>
                        @endforeach
                    </select>
                    <select class="eval" name="hot_water_eval">
                        <option value="" hidden>お湯評価</option>
                        @foreach ($evals as $eval)
                            <option value="{{ $eval->code }}">{{ $eval->name }}</option>
                        @endforeach
                    </select>
                    <select class="eval" name="rock_eval">
                        <option value="" hidden>岩盤浴評価</option>
                        @foreach ($evals as $eval)
                            <option value="{{ $eval->code }}">{{ $eval->name }}</option>
                        @endforeach
                    </select>
                    <select class="eval" name="sauna_eval">
                        <option value="" hidden>サウナ評価</option>
                        @foreach ($evals as $eval)
                            <option value="{{ $eval->code }}">{{ $eval->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('thoughts') <p class="error">{{ $message }}</p> @enderror
            <div class="list">
                <label class="field-name">感想</label>
                <textarea class="field wide-field" type="text" name="thoughts">{{ old('thoughts') }}</textarea>
            </div>

            @error('main_img') <p class="error">{{ $message }}</p> @enderror
            <div class="list choose-img">
                <span class="field-name">お風呂画像</span>
                <div class="img-field">
                    <label class="img-label" for="mainImg">
                        <input class="field file" id="mainImg" type="file" name="main_img" value="{{ old('main_img') }}">
                        <img class="preview-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="お風呂メイン画像 プレビュー">
                    </label>
                    <a href="" class="dlt-img hide"><span class="btn-text">削除</span></a>
                </div>
            </div>
            @error('sub1_img') <p class="error">{{ $message }}</p> @enderror
            <div class="list choose-img">
                <span class="field-name">お風呂サブ画像1</span>
                <div class="img-field">
                    <label class="img-label" for="subImg1">
                        <input class="field file" id="subImg1" type="file" name="sub1_img" value="{{ old('sub1_img') }}">
                        <img class="preview-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="お風呂サブ画像1 プレビュー">
                    </label>
                    <a href="" class="dlt-img hide"><span class="btn-text">削除</span></a>
                </div>
            </div>
            @error('sub2_img') <p class="error">{{ $message }}</p> @enderror
            <div class="list choose-img">
                <span class="field-name">お風呂サブ画像2</span>
                <div class="img-field">
                    <label class="img-label" for="subImg2">
                        <input class="field file" id="subImg2" type="file" name="sub2_img" value="{{ old('sub2_img') }}">
                        <img class="preview-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="お風呂サブ画像2 プレビュー">
                    </label>
                    <a href="" class="dlt-img hide"><span class="btn-text">削除</span></a>
                </div>
            </div>
            @error('sub3_img') <p class="error">{{ $message }}</p> @enderror
            <div class="list choose-img">
                <span class="field-name">お風呂サブ画像3</span>
                <div class="img-field">
                    <label class="img-label" for="subImg3">
                        <input class="field file" id="subImg3" type="file" name="sub3_img" value="{{ old('sub3_img') }}">
                        <img class="preview-img" src="{{ asset('svg/bath-mark-light-blue.svg') }}" alt="お風呂サブ画像3 プレビュー">
                    </label>
                    <a href="" class="dlt-img hide"><span class="btn-text">削除</span></a>
                </div>
            </div>
            <button class="btn" type="submit">登録する</button>
        </form>
    </div>
@endsection
