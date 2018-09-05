@extends('admin.layouts.default')

@section('style')
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
@stop

@section('content')

<div class="login-main">
    <header class="layui-elip">后台登录</header>
    <form class="layui-form" action="{{ route('admin.login') }}" method="post" id="form_id">
        {{ @csrf_field() }}

        <div class="layui-input-inline">
            <input type="text" name="account" required lay-verify="required|title" placeholder="帐号" autocomplete="off"
                   class="layui-input" value="{{ old('account') }}">
        </div>
        <div class="layui-input-inline">
            <input type="password" name="password" required lay-verify="required|pass" placeholder="密码" autocomplete="off"
                   class="layui-input">
        </div>
        <div class="layui-input-inline login-btn">
            <button type="submit" class="layui-btn">登录</button>
        </div>
        <hr/>

    </form>
    <p class="bottom-own">Aozom@版权所有</p>
</div>
@stop

@section('javascript')

    <script type="text/javascript">
        layui.use(['form'], function () {

            // 操作对象
            var form = layui.form
                        ,layer = layui.layer;

            // you code ...
            form.verify({
                title: function(value){
                    if(value.length < 5){
                        return '登录帐户不正确';
                    }
                }
                ,pass: [/(.+){6,12}$/, '登录密码不正确']
            });

            //提交错误返回提示信息
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    layer.msg("{{ $error }}");
            @endforeach
            @endif


        });
    </script>
@stop