@extends('admin.layouts._iframe_default')

@section('style')

@stop

@section('content')

    <!-- 工具集 -->
    <div class="my-btn-box">
        <span class="fl">
            <a class="layui-btn layui-btn-small"  href="javascript:history.back(-1)"><i class="layui-icon">&#xe65c;</i></a>
            <a class="layui-btn layui-btn-small "  href="javascript:location.reload();"><i class="layui-icon">&#x1002;</i></a>
        </span>
    </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>管理员详细信息</legend>
    </fieldset>

    <form class="layui-form layui-form-pane" action="">

        <div class="layui-form-item">
            <label class="layui-form-label">登录帐户</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->account }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">权限组</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->role_name }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->name }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">帐户状态</label>
            <div class="layui-input-block">
                <input readonly  value="@if($admin->status) 开启 @else 禁用 @endif" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">登录总次数</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->log_count }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">最后登录IP</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->last_ip }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">最后登录时间</label>
            <div class="layui-input-block">
                <input readonly  value="{{ $admin->last_at }}" class="layui-input layui-input-5">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label layui-input-5">备注信息</label>
            <div class="layui-input-block">
                <textarea readonly class="layui-textarea layui-input-5">{{ $admin->remarks }}</textarea>
            </div>
        </div>





    </form>


@stop
@section('javascript')


    <script>
        layui.use(['form'], function(){
            var form = layui.form
                ,layer = layui.layer;
            var $ = jQuery = layui.$;


        });



    </script>



@stop
