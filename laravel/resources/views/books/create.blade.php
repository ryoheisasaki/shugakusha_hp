@extends('layouts.app')

@section('title', '書籍追加 | 修学社')

@section('content')
    <div class="book_page">
        @include('components.site_header')

        <section class="book_title_area">
            <div class="book_inner">
                <h1 class="book_page_title">本を追加</h1>
                <div style="margin-top: 12px;">
                    <a href="{{ url('/books') }}">書籍一覧へ戻る</a>
                </div>
            </div>
        </section>

        <section class="book_list_area">
            <div class="book_inner">
                @if ($errors->any())
                    <div style="margin-bottom: 24px; padding: 16px 20px; border: 1px solid #d66; background: #fff4f4; color: #b30000; border-radius: 8px;">
                        <p style="margin: 0 0 8px 0; font-weight: bold;">入力内容を確認してください。</p>
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="background: #fff; border: 1px solid #ddd; border-radius: 16px; padding: 32px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    <form method="POST" action="{{ url('/books/store') }}" enctype="multipart/form-data">
                        @csrf

                        <div style="display: grid; gap: 24px;">
                            <div>
                                <h2 style="margin: 0 0 16px 0; font-size: 24px;">基本情報</h2>

                                <div style="display: grid; gap: 16px;">
                                    <div>
                                        <label for="image" style="display: block; margin-bottom: 8px; font-weight: bold;">画像</label>
                                        <input
                                            type="file"
                                            id="image"
                                            name="image"
                                            style="width: 100%; padding: 10px 0;"
                                        >
                                    </div>

                                    <div>
                                        <label for="title" style="display: block; margin-bottom: 8px; font-weight: bold;">タイトル</label>
                                        <input
                                            type="text"
                                            id="title"
                                            name="title"
                                            value="{{ old('title') }}"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                        <div>
                                            <label for="price" style="display: block; margin-bottom: 8px; font-weight: bold;">価格</label>
                                            <input
                                                type="number"
                                                id="price"
                                                name="price"
                                                value="{{ old('price') }}"
                                                style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                            >
                                        </div>

                                        <div>
                                            <label for="pages" style="display: block; margin-bottom: 8px; font-weight: bold;">ページ数</label>
                                            <input
                                                type="number"
                                                id="pages"
                                                name="pages"
                                                value="{{ old('pages') }}"
                                                style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                            >
                                        </div>
                                    </div>

                                    <div>
                                        <label for="size" style="display: block; margin-bottom: 8px; font-weight: bold;">サイズ</label>
                                        <input
                                            type="text"
                                            id="size"
                                            name="size"
                                            value="{{ old('size') }}"
                                            placeholder="例: A5"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>

                                    <div>
                                        <label for="description" style="display: block; margin-bottom: 8px; font-weight: bold;">説明</label>
                                        <textarea
                                            id="description"
                                            name="description"
                                            rows="6"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px; resize: vertical;"
                                        >{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div style="border-top: 1px solid #e5e5e5; padding-top: 24px;">
                                <h2 style="margin: 0 0 16px 0; font-size: 24px;">サイズ詳細</h2>

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                                    <div>
                                        <label for="width" style="display: block; margin-bottom: 8px; font-weight: bold;">横幅 (cm)</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            id="width"
                                            name="width"
                                            value="{{ old('width') }}"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>

                                    <div>
                                        <label for="height" style="display: block; margin-bottom: 8px; font-weight: bold;">縦 (cm)</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            id="height"
                                            name="height"
                                            value="{{ old('height') }}"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>

                                    <div>
                                        <label for="depth" style="display: block; margin-bottom: 8px; font-weight: bold;">厚さ (cm)</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            id="depth"
                                            name="depth"
                                            value="{{ old('depth') }}"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>

                                    <div>
                                        <label for="weight" style="display: block; margin-bottom: 8px; font-weight: bold;">重量 (kg)</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            id="weight"
                                            name="weight"
                                            value="{{ old('weight') }}"
                                            style="width: 100%; padding: 12px 14px; border: 1px solid #ccc; border-radius: 8px;"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 16px; align-items: center; padding-top: 8px;">
                                <button
                                    type="submit"
                                    class="detail_cart_btn"
                                    style="border: none; cursor: pointer;"
                                >
                                    登録する
                                </button>

                                <a href="{{ url('/books') }}" style="text-decoration: none;">
                                    キャンセル
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        @include('components.site_footer')
    </div>
@endsection
