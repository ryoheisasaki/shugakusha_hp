@extends('layouts.app')

@section('title', '送信完了 | 修学社')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="book_title_area">
            <div class="book_inner">
                <h1 class="book_page_title">送信完了</h1>
            </div>
        </section>

        <section class="book_list_area">
            <div class="book_inner">
                <p>購入希望メールを送信しました。</p>
                <p>担当者よりご連絡いたしますので、しばらくお待ちください。</p>

                <div style="margin-top: 24px;">
                    <a href="{{ url('/books') }}">書籍一覧へ戻る</a>
                </div>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
