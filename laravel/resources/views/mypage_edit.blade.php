@extends('layouts.app')

@section('title', '情報編集')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>会員情報編集</h1>
        </section>

        <section class="auth_page">
            <div class="auth_box">

                <form action="{{ url('/mypage/update') }}" method="post" class="auth_form">
                    @csrf

                    <div class="auth_form_row">
                        <div class="auth_form_group">
                            <label>姓</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                            @error('last_name')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth_form_group">
                            <label>名</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                            @error('first_name')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="auth_form_group">
                        <label>性別</label>
                        <select name="gender">
                            <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>未設定</option>
                            <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>女性</option>
                        </select>
                        @error('gender')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_row">
                        <div class="auth_form_group">
                            <label>年齢</label>
                            <input type="number" name="age" value="{{ old('age', $user->age) }}">
                            @error('age')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth_form_group">
                            <label>電話番号</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr style="margin: 30px 0;">

                    <h3>パスワード変更</h3>

                    <div class="auth_form_group">
                        <label>現在のパスワード</label>
                        <input type="password" name="current_password">
                        @error('current_password')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_group">
                        <label>新しいパスワード</label>
                        <div class="password_field">
                            <input type="password" name="new_password" id="new_password">
                            <button type="button" onclick="togglePassword('new_password')">👁</button>
                        </div>
                        @error('new_password')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_group">
                        <label>新しいパスワード（確認）</label>
                        <div class="password_field">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                            <button type="button" onclick="togglePassword('new_password_confirmation')">👁</button>
                        </div>
                    </div>

                    <button type="submit" class="detail_cart_btn">
                        保存する
                    </button>
                </form>

            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
