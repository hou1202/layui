@extends('admin.layouts._iframe_default')

@section('style')
{{-- laravel Ajax提交表单，头部TOKEN --}}
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

@stop

@section('content')

<form class="layui-form" method="POST" id="form_id">

    {{ csrf_field() }}

    <div class="layui-form-item">
        <label class="layui-form-label">导航名称</label>
        <div class="layui-input-block">
            <input type="text" name="title" lay-verify="required|title" placeholder="导航名称" autocomplete="off" class="layui-input layui-input-9" value="{{ old('tile') }}" >
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">导航路由</label>
        <div class="layui-input-block">
            <input type="text" name="route" lay-verify="required|route" placeholder="导航路由(主目录填写：#)" autocomplete="off" class="layui-input layui-input-9" value="{{ old('route') }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">目录图标</label>
        <div class="layui-input-block">
            <input type="text" name="icon" lay-verify="required|icon" placeholder="目录图标（默认：'#xe620'）" autocomplete="off" class="layui-input layui-input-9" value="{{ old('icon','#xe620') }}" >
        </div>
    </div>

    <div class="layui-form-item layui-input-9">
        <label class="layui-form-label">所属目录</label>
        <div class="layui-input-block">
            <select name="type_id" lay-verify="required|number">
                <option value="0" selected="">主目录</option>
                @foreach( $menu as $item)
                    <option value="{{ $item->id }}" >{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" id="permission" lay-submit="permissions" lay-filter="permissions">立即提交</button>
        </div>
    </div>



</form>


@stop
@section('javascript')


<script>
    layui.use(['form','jquery'], function(){
        var form = layui.form
            ,layer = layui.layer;
        var $ = jQuery = layui.$;


        //自定义验证规则
        form.verify({

            title: function(value){
                if(value.length > 8){
                    return '权限目录名称不得大于8个字';
                }
            }
            ,route:function(value){
                if(value.length > 250){
                    return '权限目录路由不正确'
                }

            }
            ,icon:function(value){
                if(value.length > 50 || value.length < 2) {
                    return '目录图标信息有误';
                }
            }

        });


        //监听提交
        form.on('submit(permissions)', function(data){

                $.ajax({
                    url:'{{ route('permissions.store') }} ',
                    type:'POST',
                    dataType:'json',
                    data:$("#form_id").serialize(),
                    success:function(data){
                        layer.msg(data.msg);
                        if(data.code == 1){
                            layer.msg(data.msg);
                            //延迟关闭弹出层，并刷新交页面窗口
                            setTimeout(function(){
                                window.parent.location.reload();
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                            },2500);
                        }else if(data.code == 0){
                            layer.msg(data.msg);
                        }else{
                            layer.msg("网络错误，请重试...");
                        }
                    },
                    error:function () {
                        layer.msg("网络错误，请重试...");
                    }
                });
                return false



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
