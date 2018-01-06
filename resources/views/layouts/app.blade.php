<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--继承此模板的页面，如果没有定制 title 区域的话，就会自动使用第二个参数 LaraBBS 作为标题前缀-->
    <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

    <!-- Styles  使用当前请求的协议（ HTTP 或 HTTPS ）为资源文件生成一个 URL，以我们的情况，会生成 http://larabbs.app/css/app.css-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
<!--route_class() 是我们自定义的辅助方法，我们还需要在 helpers.php 文件中添加此方法-->
<div id="app" class="{{ route_class() }}-page">
    <!--加载顶部导航区块的子模板-->
    @include('layouts._header')

    <div class="container">
        @include('layouts._message')
        <!--占位符声明，允许继承此模板的页面注入内容-->
        @yield('content')

    </div>
    <!--加载页面尾部导航区块的子模板-->
    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>