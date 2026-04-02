@extends('layouts.app')

@section('title', '購入手続き | 修学社')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="book_title_area">
            <div class="book_inner">
                <h1 class="book_page_title">購入手続き</h1>
            </div>
        </section>

        <section class="book_list_area">
            <div class="book_inner">
                @if ($errors->any())
                    <div style="margin-bottom: 24px; color: red;">
                        <ul style="padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="margin-bottom: 32px;">
                    <h2 style="margin-bottom: 16px;">ご注文内容</h2>

                    @foreach ($cart_items as $item)
                        <div style="padding: 16px 0; border-bottom: 1px solid #ccc;">
                            <p>書籍名：{{ $item['title'] }}</p>
                            <p>数量：{{ $item['quantity'] }}</p>
                            <p>単価：{{ number_format($item['price']) }}円</p>
                            <p>小計：{{ number_format($item['subtotal']) }}円</p>
                        </div>
                    @endforeach

                    <div style="margin-top: 20px;">
                        <p>商品合計：{{ number_format($subtotal) }}円</p>
                        <p>送料：{{ number_format($shipping_fee) }}円</p>
                        <p><strong>合計：{{ number_format($total) }}円</strong></p>
                    </div>
                </div>

                    <form method="POST" action="{{ url('/cart/checkout') }}">
                        @csrf

                        <div style="margin-bottom: 16px;">
                            <label for="name">お名前</label><br>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $login_user->name ?? '') }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="postal_code">郵便番号</label><br>
                            <input
                                type="text"
                                id="postal_code"
                                name="postal_code"
                                value="{{ old('postal_code', $login_user->postal_code ?? '') }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="address">住所</label><br>
                            <input
                                type="text"
                                id="address"
                                name="address"
                                value="{{ old('address', $login_user->address ?? '') }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="email">メールアドレス</label><br>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $login_user->email ?? '') }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="phone">電話番号</label><br>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone', $login_user->phone ?? '') }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="note">備考</label><br>
                            <textarea
                                id="note"
                                name="note"
                                rows="5"
                                style="width: 100%; max-width: 500px;"
                            >{{ old('note') }}</textarea>
                        </div>

                        <div style="margin-top: 24px;">
                            <button type="submit" class="detail_cart_btn">購入希望メールを送信</button>
                        </div>
                    </form>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
