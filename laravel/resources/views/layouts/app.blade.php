<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title', '修学社')</title>
    <meta name="description" content="@yield('description', '修学社の書籍案内。')"/>

    <link rel="stylesheet" href="{{ asset('main.css') }}">
    <link rel="icon" href="/favicon.ico">
</head>
<body>
@yield('content')

@if(session('success'))
    <div class="flash_success">
        {{ session('success') }}
    </div>
@endif

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
</body>
</html>
