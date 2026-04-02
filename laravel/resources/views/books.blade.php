@extends('layouts.app')

@section('title', '書籍一覧 | 修学社')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="book_title_area">
            <div class="book_inner">
                <h1 class="book_page_title">書籍一覧</h1>

                @php
                    $user = session('user');
                    $login_user = null;

                    if ($user && !empty($user['id'])) {
                        $login_user = \App\Models\User::find($user['id']);
                    }
                @endphp

                @if($login_user && $login_user->is_admin)
                    <div style="margin-top: 12px; display: flex; gap: 16px; flex-wrap: wrap;">
                        <a href="{{ url('/books/create') }}">書籍を追加</a>
                        <a href="{{ url('/admin/books') }}">非公開一覧（管理者用）</a>
                    </div>
                @endif
            </div>
        </section>

        <section class="book_list_area">
            <div class="book_inner">
                <div class="book_grid">
                    @foreach ($books as $book)
                        <article class="book_card">
                            <a href="{{ url('/books/' . $book['id']) }}" class="book_image_link">
                                @if (!empty($book['image']))
                                    <img src="{{ asset($book['image']) }}" alt="{{ $book['title'] }}" class="book_image">
                                @else
                                    <div class="book_image" style="display: flex; align-items: center; justify-content: center; background: #f3f3f3;">
                                        画像なし
                                    </div>
                                @endif
                            </a>

                            <div class="book_meta">
                                <a href="{{ url('/books/' . $book['id']) }}" class="book_name">
                                    {{ $book['title'] }}
                                </a>
                                <p>{{ $book['size'] }}　{{ $book['pages'] }}ページ</p>
                                <p>定価{{ number_format($book['price']) }}円</p>

                                @if($login_user && $login_user->is_admin)
                                    <div style="margin-top: 12px; display: flex; gap: 12px; flex-wrap: wrap;">
                                        <a href="{{ url('/admin/books/' . $book['id'] . '/edit') }}">編集</a>

                                        <form action="{{ url('/admin/books/' . $book['id'] . '/delete') }}" method="post" onsubmit="return confirm('「{{ $book['title'] }}」を削除しますか？');" style="margin: 0;">
                                            @csrf
                                            <button
                                                type="submit"
                                                style="background: none; border: none; padding: 0; color: #c00; cursor: pointer; text-decoration: underline;"
                                            >
                                                削除
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
