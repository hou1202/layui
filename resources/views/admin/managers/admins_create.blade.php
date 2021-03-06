@extends('admin.layouts._iframe_default')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <legend>添加管理员</legend>
    </fieldset>

    <form class="layui-form" action="{{ route('admins.store') }}" method="post" id="form_id">

        {{ @csrf_field() }}

        <div class="layui-form-item">
            <label class="layui-form-label">登录帐号</label>
            <div class="layui-input-block">
                <input type="text" name="account" lay-verify="required|title" placeholder="登录帐号" autocomplete="off" class="layui-input layui-input-5" value="{{ old('account') }}" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">登录密码</label>
            <div class="layui-input-block">
                <input type="password" id="oldPwd" name="password" lay-verify="required|pass" placeholder="登录密码" autocomplete="off" class="layui-input layui-input-5" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
                <input type="password" name="password_confirmation" lay-verify="required|confirm" placeholder="确认密码" autocomplete="off" class="layui-input layui-input-5" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required|name" placeholder="真实姓名" autocomplete="off" class="layui-input layui-input-5" value="{{ old('name') }}" >
            </div>
        </div>

        <div class="layui-form-item layui-input-5">
            <label class="layui-form-label">所属权限</label>
            <div class="layui-input-block">
                <select name="role_id" lay-verify="role">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" >{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">帐户状态</label>
            <div class="layui-input-block">
                <input type="checkbox" checked="" name="status" lay-skin="switch" lay-filter="switchTest" lay-text="开启|禁用" value="1">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注说明</label>
            <div class="layui-input-block">
                <textarea placeholder="备注说明内容信息" lay-verify="remarks" class="layui-textarea layui-textarea-5" name="remarks">{{ old('remarks') }} </textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="admins">立即提交</button>
            </div>
        </div>



    </form>


@stop
@section('javascript')


    <script>
        layui.use(['form', 'layedit',], function(){
            var form = layui.form
                ,layer = layui.layer;


            //自定义验证规则
            form.verify({

                title: function(value){
                    if(value.length < 5){
                        return '登录帐户不得少于5个字符';
                    }
                }
                ,pass: [/(.+){6,12}$/, '密码必须6到12位']
                ,confirm: [/(.+){6,12}$/, '密码不一致']
                ,name:function(value){
                    if(value.length > 5 || value.length < 2) {
                        return '真实姓名信息有误';
                    }
                }
                ,remarks: function (value) {
                    if(value.length > 85){
                        return  '备注信息不得大于85个字'
                    }

                }

            });

            //监听提交
            form.on('submit(admins)', function(data){

            });
            

        });



    </script>



@stop
