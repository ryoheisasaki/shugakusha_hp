@extends('layouts.app')

@section('title', '修学社')
@section('description', '修学社の書籍案内。')

@section('content')
    @php
        $cart_count = array_sum(session('cart', []));
    @endphp

    <div class="book_page">
        @include('components.site_header')

        <section class="book_title_area">
            <div class="book_inner">
                <h1 class="book_page_title">修学社</h1>
            </div>
        </section>

        <main>
            <section class="top_intro_section">
                <div class="book_inner">
                    <div class="top_intro_box">
                        <p class="top_intro_kicker">暮らしに寄り添う“読みもの”と“暦”の本屋</p>
                        <h2 class="top_intro_title">本と出会う場所</h2>
                        <p class="top_intro_text">
                            修学社の刊行物を、わかりやすく、探しやすく。<br>
                            書籍一覧からお好みの一冊をお探しください。
                        </p>

                        <div class="top_intro_actions">
                            <a class="detail_cart_btn" href="{{ url('/books') }}">書籍一覧を見る</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('components.site_footer')
    </div>
@endsection
