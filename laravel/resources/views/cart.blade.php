@extends('layouts.app')

@section('title', 'カート')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>カート</h1>
        </section>

        <section class="cart_page">
            <div class="book_inner">
                @if (count($cart_items) === 0)
                    <p class="cart_empty">カートに商品が入っていません。</p>
                @else
                    <div class="cart_header_row">
                        <div></div>
                        <div></div>
                        <div>数量</div>
                        <div>小計</div>
                    </div>

                    @foreach ($cart_items as $item)
                        <div class="cart_row">
                            <div class="cart_image">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                            </div>

                            <div class="cart_info">
                                <div class="cart_title">{{ $item['title'] }}</div>
                                <div class="cart_price_line">単価：{{ number_format($item['price']) }}円</div>

                                <form action="{{ url('/cart/remove/' . $item['id']) }}" method="post">
                                    @csrf
                                    <button type="submit" class="cart_remove_btn">削除</button>
                                </form>
                            </div>

                            <div class="cart_quantity">
                                <form action="{{ url('/cart/update/' . $item['id']) }}" method="post" class="cart_quantity_form">
                                    @csrf
                                    <input type="number" name="quantity" min="0" value="{{ $item['quantity'] }}">
                                    <button type="submit">更新</button>
                                </form>
                            </div>

                            <div class="cart_subtotal">
                                ¥{{ number_format($item['subtotal']) }}
                            </div>
                        </div>
                    @endforeach

                    <div class="cart_total_box">
                        <div class="cart_total_left">
                            <p>商品合計：¥{{ number_format($subtotal) }}</p>
                            <p>送料：¥{{ number_format($shipping_fee) }}</p>
                        </div>

                        <div class="cart_total_right">
                            <p>合計：¥{{ number_format($total) }}</p>
                        </div>
                    </div>
                    @if (!empty($cart_items))
                        <div style="margin-top: 24px; text-align: right;">
                            <a href="{{ url('/cart/checkout') }}" class="detail_cart_btn" style="display: inline-block; text-decoration: none;">
                                購入手続きへ
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
