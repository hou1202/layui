@extends('admin.layouts._iframe_default')

@section('style')
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
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
        <legend>添加管理员角色</legend>
    </fieldset>

    <form class="layui-form" action="{{ route('roles.store') }}" method="post" id="form_id">

        {{ @csrf_field() }}

        <div class="layui-form-item">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="required|title" placeholder="角色名称" autocomplete="off" class="layui-input layui-input-5" value="{{ old('name') }}" >
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">角色权限</label>
            <div class="layui-input-block">
                @foreach($permissions as $permission)
                    @if($permission->is_menu)
                        <div>
                            <div class="main-check">
                                <input type="checkbox" class="main-input" lay-filter="main-input" name="per_id[]" lay-skin="primary" value="{{ $permission -> id }}" title="{{ $permission -> title }}" checked="">
                            </div>
                            @foreach($permissions as $per)
                                @if($per ->type_id == $permission->id)
                                    <input type="checkbox" class="child-input" lay-filter="child-input" name="per_id[]" lay-skin="primary" value="{{ $per -> id }}" title="{{ $per -> title }}" checked="">
                                @endif
                            @endforeach
                            <hr/>
                        </div>
                    @endif
                @endforeach
            </div>



            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="roles">立即提交</button>
            </div>
        </div>



    </form>


@stop
@section('javascript')


    <script>
        layui.use(['form', 'layedit',], function(){
            var form = layui.form
                ,layer = layui.layer;
            var $ = jQuery = layui.$;


            //自定义验证规则
            form.verify({

                title: function(value){
                    if(value.length < 2){
                        return '登录帐户不得少于2个字符';
                    }
                }

            });

            //监听提交
           /* form.on('submit(roles)', function(data){
                layer.alert(data);
            });
            */


            /*
            * checked 一级目录监听
            * 全选或全消
            * */
            form.on('checkbox(main-input)',function(data){

                var m_state = data.elem.checked;
                if(m_state == true){
                    $(this).parent().siblings("input[type=checkbox]").prop("checked", true);
                    form.render('checkbox');
                }else{
                    $(this).parent().siblings("input[type=checkbox]").prop("checked", false);
                    form.render('checkbox');
                }
            });

            /*
            * checked 二级目录监听
            * 二级目录有选中，则一级目录必须选中
            * */
            form.on('checkbox(child-input)',function(data){
               var c_state = data.elem.checked;
               var p_state = $(this).siblings(".main-check").children("input.main-input");
               if(c_state == true){
                   if(!p_state.is(':checked')){
                       p_state.prop("checked", true);
                       form.render();
                   }

               }
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