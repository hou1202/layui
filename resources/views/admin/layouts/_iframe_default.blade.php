<!DOCTYPE html>
<html lang="{{ app() -> getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title','Aozom管理后台')</title>

    <link rel="stylesheet" href="/admin/frame/layui/css/layui.css">

    <link rel="stylesheet" href="/admin/frame/static/css/style.css">

    <link rel="stylesheet" href="/admin/frame/static/css/public.css">

    <link rel="icon" href="/admin/frame/static/image/code.png">
    @yield('style')
</head>
<body class="body">

    @yield('content')


<script type="text/javascript" src="/admin/frame/layui/layui.js"></script>
    @yield('javascript')

    <script>
        layui.use(['layer'], function () {
            //提交错误返回提示信息
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    layer.msg("{{ $error }}");
                @endforeach
            @endif
        });
    </script>
</body>
</html>