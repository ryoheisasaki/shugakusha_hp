@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    @php
        $cart_count = array_sum(session('cart', []));
    @endphp

    <div class="book_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>ログイン</h1>
        </section>

        <section class="auth_page">
            <div class="auth_box">
                <form action="{{ url('/login') }}" method="post" class="auth_form">
                    @csrf

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

                    <button type="submit" class="detail_cart_btn auth_submit_btn">ログインする</button>
                </form>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
