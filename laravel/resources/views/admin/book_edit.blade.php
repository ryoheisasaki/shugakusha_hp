@extends('layouts.app')

@section('title', '書籍編集')

@section('content')
    <div class="detail_page">
        @include('components.site_header')

        <section class="detail_title_area">
            <h1>書籍編集</h1>
        </section>

        <section class="detail_main">
            <div class="detail_inner">
                <div class="detail_info" style="width: 100%;">
                    <h2 class="detail_book_title">書籍情報を編集</h2>

                    @if ($errors->any())
                        <div style="margin-bottom: 20px; color: red;">
                            <ul style="padding-left: 20px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/admin/books/' . $book->id . '/update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div style="margin-bottom: 16px;">
                            <label for="image">画像</label><br>

                            @if (!empty($book->image))
                                <div style="margin-bottom: 8px;">
                                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" style="max-width: 180px;">
                                </div>
                            @endif

                            <input type="file" id="image" name="image">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="title">タイトル</label><br>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $book->title) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="price">価格</label><br>
                            <input
                                type="number"
                                id="price"
                                name="price"
                                value="{{ old('price', $book->price) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="size">サイズ</label><br>
                            <input
                                type="text"
                                id="size"
                                name="size"
                                value="{{ old('size', $book->size) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="pages">ページ数</label><br>
                            <input
                                type="number"
                                id="pages"
                                name="pages"
                                value="{{ old('pages', $book->pages) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="description">説明</label><br>
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                style="width: 100%; max-width: 500px;"
                            >{{ old('description', $book->description) }}</textarea>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="width">横幅</label><br>
                            <input
                                type="number"
                                step="0.01"
                                id="width"
                                name="width"
                                value="{{ old('width', $book->width) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="height">高さ</label><br>
                            <input
                                type="number"
                                step="0.01"
                                id="height"
                                name="height"
                                value="{{ old('height', $book->height) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="depth">厚さ</label><br>
                            <input
                                type="number"
                                step="0.01"
                                id="depth"
                                name="depth"
                                value="{{ old('depth', $book->depth) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label for="weight">重量</label><br>
                            <input
                                type="number"
                                step="0.01"
                                id="weight"
                                name="weight"
                                value="{{ old('weight', $book->weight) }}"
                                style="width: 100%; max-width: 500px;"
                            >
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label>
                                <input
                                    type="checkbox"
                                    name="is_published"
                                    value="1"
                                    {{ old('is_published', $book->is_published) ? 'checked' : '' }}
                                >
                                公開する
                            </label>
                        </div>

                        <div style="margin-top: 24px;">
                            <button type="submit" class="detail_cart_btn">更新する</button>
                            <a href="{{ url('/books/' . $book->id) }}" class="detail_cart_btn" style="margin-left: 12px; text-decoration: none; display: inline-block;">
                                戻る
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
