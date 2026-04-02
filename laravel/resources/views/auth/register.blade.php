@extends('layouts.app')

@section('title', '会員登録')

@section('content')
    @php
        $cart_count = array_sum(session('cart', []));
    @endphp

    <div class="book_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>会員登録</h1>
        </section>

        <section class="auth_page">
            <div class="auth_box">
                <form action="{{ url('/register') }}" method="post" class="auth_form">
                    @csrf

                    <div class="auth_form_row">
                        <div class="auth_form_group">
                            <label for="last_name">姓</label>
                            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth_form_group">
                            <label for="first_name">名</label>
                            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}">
                            @error('first_name')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="auth_form_group">
                        <label for="gender">性別</label>
                        <select id="gender" name="gender">
                            <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>未設定</option>
                            <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ old('gender') == '2' ? 'selected' : '' }}>女性</option>
                        </select>
                        @error('gender')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_row">
                        <div class="auth_form_group">
                            <label for="age">年齢</label>
                            <input id="age" type="number" name="age" value="{{ old('age') }}">
                            @error('age')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="auth_form_group">
                            <label for="phone">電話番号</label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <p class="auth_error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="auth_form_group">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_group">
                        <label for="password">パスワード</label>
                        <input id="password" type="password" name="password">
                        @error('password')
                        <p class="auth_error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth_form_group">
                        <label for="password_confirmation">パスワード確認</label>
                        <input id="password_confirmation" type="password" name="password_confirmation">
                    </div>

                    <button type="submit" class="detail_cart_btn auth_submit_btn">登録する</button>
                </form>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
