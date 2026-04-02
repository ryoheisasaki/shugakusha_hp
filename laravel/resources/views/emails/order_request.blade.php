書籍購入希望がありました。

【ご注文内容】
@foreach ($cart_items as $item)
    ----------------------------------------
    書籍名：{{ $item['title'] }}
    数量：{{ $item['quantity'] }}
    単価：{{ number_format($item['price']) }}円
    小計：{{ number_format($item['subtotal']) }}円
@endforeach

----------------------------------------
商品合計：{{ number_format($subtotal) }}円
送料：{{ number_format($shipping_fee) }}円
合計：{{ number_format($total) }}円

【お客様情報】
お名前：{{ $customer['name'] }}
郵便番号：{{ $customer['postal_code'] }}
住所：{{ $customer['address'] }}
メールアドレス：{{ $customer['email'] }}
電話番号：{{ $customer['phone'] }}
備考：{{ $customer['note'] ?? '' }}
