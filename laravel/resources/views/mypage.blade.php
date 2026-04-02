@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>マイページ</h1>
        </section>

        <section class="mypage_section">
            <div class="mypage_box">
                <h2 class="mypage_heading">会員情報</h2>

                <div class="mypage_table">
                    <div class="mypage_row">
                        <div class="mypage_label">姓</div>
                        <div class="mypage_value">{{ $user->last_name }}</div>
                    </div>

                    <div class="mypage_row">
                        <div class="mypage_label">名</div>
                        <div class="mypage_value">{{ $user->first_name }}</div>
                    </div>

                    <div class="mypage_row">
                        <div class="mypage_label">性別</div>
                        <div class="mypage_value">
                            @if($user->gender === 1)
                                男性
                            @elseif($user->gender === 2)
                                女性
                            @else
                                未設定
                            @endif
                        </div>
                    </div>

                    <div class="mypage_row">
                        <div class="mypage_label">年齢</div>
                        <div class="mypage_value">{{ $user->age ?? '未登録' }}</div>
                    </div>

                    <div class="mypage_row">
                        <div class="mypage_label">電話番号</div>
                        <div class="mypage_value">{{ $user->phone ?? '未登録' }}</div>
                    </div>

                    <div class="mypage_row">
                        <div class="mypage_label">メールアドレス</div>
                        <div class="mypage_value">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="mypage_actions">
                    <a href="{{ url('/mypage/edit') }}" class="detail_cart_btn">
                        情報を編集する
                    </a>
                </div>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
