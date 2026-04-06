<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller {

    private const SHIPPING_FEE = 500;

    public function index() {
        $cart = session()->get('cart', []);
        $cart_items = [];
        $subtotal = 0;

        foreach ($cart as $book_id => $quantity) {
            $book = Book::find($book_id);

            if (!$book) continue;

            $item_subtotal = $book->price * $quantity;
            $subtotal += $item_subtotal;

            $cart_items[] = [
                'id' => $book->id,
                'title' => $book->title,
                'image' => $book->image,
                'price' => $book->price,
                'quantity' => $quantity,
                'subtotal' => $item_subtotal,
            ];
        }

        $shipping_fee = count($cart_items) > 0 ? self::SHIPPING_FEE : 0;
        $total = $subtotal + $shipping_fee;

        return view('cart', compact('cart_items', 'subtotal', 'shipping_fee', 'total'));
    }

    public function add($id) {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = 0;
        }

        $cart[$id]++;

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function update($id) {
        $quantity = (int)request('quantity', 1);
        $cart = session()->get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $quantity;
        }

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function remove($id) {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect('/cart');
    }

    public function checkout() {
        $cart = session('cart', []);
        $cart_items = [];
        $subtotal = 0;

        foreach ($cart as $book_id => $quantity) {
            $book = \App\Models\Book::find($book_id);

            if (!$book) {
                continue;
            }

            $item_subtotal = $book->price * $quantity;
            $subtotal += $item_subtotal;

            $cart_items[] = [
                'id' => $book->id,
                'title' => $book->title,
                'image' => $book->image,
                'price' => $book->price,
                'quantity' => $quantity,
                'subtotal' => $item_subtotal,
            ];
        }

        $shipping_fee = count($cart_items) > 0 ? self::SHIPPING_FEE : 0;
        $total = $subtotal + $shipping_fee;

        return view('cart_checkout', compact('cart_items', 'subtotal', 'shipping_fee', 'total'));
    }


    public function sendOrderRequest(Request $request): RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'note' => 'nullable|string',
        ]);

        $cart = session('cart', []);
        $cart_items = [];
        $subtotal = 0;

        foreach ($cart as $book_id => $quantity) {
            $book = \App\Models\Book::find($book_id);

            if (!$book) {
                continue;
            }

            $item_subtotal = $book->price * $quantity;
            $subtotal += $item_subtotal;

            $cart_items[] = [
                'id' => $book->id,
                'title' => $book->title,
                'image' => $book->image,
                'price' => $book->price,
                'quantity' => $quantity,
                'subtotal' => $item_subtotal,
            ];
        }

        $shipping_fee = count($cart_items) > 0 ? self::SHIPPING_FEE : 0;
        $total = $subtotal + $shipping_fee;

        $body = "修学社サイトより購入希望がありました。\n\n";
        $body .= "【注文者情報】\n";
        $body .= "お名前: {$validated['name']}\n";
        $body .= "郵便番号: {$validated['postal_code']}\n";
        $body .= "住所: {$validated['address']}\n";
        $body .= "メールアドレス: {$validated['email']}\n";
        $body .= "電話番号: {$validated['phone']}\n";
        $body .= "備考: " . ($validated['note'] ?? 'なし') . "\n\n";

        $body .= "【注文内容】\n";

        foreach ($cart_items as $item) {
            $body .= "書籍名: {$item['title']}\n";
            $body .= "数量: {$item['quantity']}\n";
            $body .= "単価: " . number_format($item['price']) . "円\n";
            $body .= "小計: " . number_format($item['subtotal']) . "円\n";
            $body .= "------------------------------\n";
        }

        $body .= "商品合計: " . number_format($subtotal) . "円\n";
        $body .= "送料: " . number_format($shipping_fee) . "円\n";
        $body .= "合計: " . number_format($total) . "円\n";

        Mail::raw($body, function ($message) use ($validated) {
            $message->to('info@shugakusha.jp')
                ->subject('【修学社】購入希望メール')
                ->replyTo($validated['email'], $validated['name']);
        });

        session()->forget('cart');

        return redirect('/cart/complete');
    }

    public function complete(): View {
        return view('cart_complete');
    }

}
