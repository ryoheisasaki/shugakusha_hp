@php
    $cart_count = array_sum(session('cart', []));
@endphp

<header class="book_header">
    <div class="book_inner book_header_inner">
        <a class="book_logo" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" class="logo_image" alt="修学社ロゴ">
        </a>

        <nav class="book_nav">
            <a href="{{ url('/books') }}">書籍一覧</a>

            @if(!session()->has('user'))
                <a href="{{ url('/register') }}">会員登録</a>
                <a href="{{ url('/login') }}">ログイン</a>
            @else
                <a href="{{ url('/mypage') }}" class="login_user_name">
                    {{ session('user.name') }}様
                </a>

                <form action="{{ url('/logout') }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout_link_button">ログアウト</button>
                </form>
            @endif

            <a href="{{ url('/cart') }}" class="cart_link">
                カート
                @if ($cart_count > 0)
                    <span class="cart_badge">{{ $cart_count }}</span>
                @endif
            </a>
        </nav>
    </div>
</header>
