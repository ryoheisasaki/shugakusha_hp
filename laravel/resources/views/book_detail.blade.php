@extends('layouts.app')

@section('title', '書籍詳細')

@section('content')
    <div class="detail_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>書籍詳細</h1>
        </section>

        <section class="detail_main">
            <div class="detail_inner">
                <div class="detail_image">
                    <img src="{{ asset($book['image']) }}" alt="{{ $book['title'] }}">
                </div>

                <div class="detail_info">
                    <h2 class="detail_book_title">{{ $book['title'] }}</h2>

                    <p class="detail_price">金額：{{ number_format($book['price']) }}円</p>
                    <p class="detail_size">サイズ：{{ $book['size'] }}　{{ $book['pages'] }}ページ</p>
                    <p class="detail_size">横幅：{{ $book['width'] }}</p>
                    <p class="detail_size">高さ：{{ $book['height'] }}</p>
                    <p class="detail_size">厚さ：{{ $book['depth'] }}</p>
                    <p class="detail_size">重量：{{ $book['weight'] }}</p>
                    <p class="detail_desc">{{ $book['description'] }}</p>

                    <form action="{{ url('/cart/add/' . $book['id']) }}" method="post">
                        @csrf
                        <button type="submit" class="detail_cart_btn">カートに入れる</button>
                    </form>
                </div>
            </div>
            @if(session()->has('user.id') && \App\Models\User::find(session('user.id'))->is_admin)
                <a href="{{ url('/admin/books/' . $book->id . '/edit') }}" class="detail_cart_btn">
                    編集
                </a>
            @endif
        </section>

        @include('components.site_footer')
    </div>
@endsection
