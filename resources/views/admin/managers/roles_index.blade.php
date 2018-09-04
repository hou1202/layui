@extends('admin.layouts._iframe_default')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/admin/frame/static/css/list.css">
@stop

@section('content')

    <!-- 工具集 -->
    <div class="my-btn-box">
        <span class="fl">
            <a class="layui-btn btn-add btn-default" id="btn-add" href="{{ route('roles.create') }}">添加</a>
            <a class="layui-btn btn-add btn-default " id="btn-refresh"><i class="layui-icon">&#x1002;</i></a>
        </span>
        <span class="fr">
            <span class="layui-form-label">搜索条件：</span>
            <div class="layui-input-inline">
                <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input">
            </div>
            <button class="layui-btn mgl-20">查询</button>
        </span>
    </div>

    <!-- 表格 -->
    <div id="dateTable"></div>
    <div class="layui-form layui-border-box layui-table-view " lay-filter="LAY-table-1">
        <table cellspacing="0" cellpadding="0" border="0" class="layui-table layui-table-custom">
            <thead>
            <tr>
                <th>ID</th>
                <th>管理组名称</th>
                <th>管理组权限</th>
                <th>创建时间</th>
                <th class="layui-body-cell-0">操作</th>
            </tr>
            </thead>
            <tbody class="layui-tbody">
            @foreach( $roles as $role)
                <tr>
                    <td class="layui-body-cell-4">{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->per_id }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td class="layui-body-cell-0">
                        <div class="">
                            <a class="layui-btn layui-btn-mini layui-btn-normal" href="{{ route('roles.edit',$role->id) }}" lay-event="edit">
                                <i class="layui-icon">&#xe642;</i>编辑
                            </a>
                            <a class="layui-btn layui-btn-mini layui-btn-danger layui-del" name="{{ $role->id }}" lay-event="del">
                                <i class="layui-icon">&#xe640;</i>删除
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <!-- 分页 -->
        <div class="layui-table-tool">
            <div class="layui-inline layui-table-page" id="layui-table-page1">
                <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
                    {!! $roles -> render() !!}
                </div>
            </div>
        </div>
    </div>

@stop
@section('javascript')
    <script type="text/javascript" src="/admin/js/index.js"></script>
    <script type="text/javascript">

        // layui方法
        layui.use(['table', 'form', 'layer', 'vip_table'], function () {

            // 操作对象
            var form = layui.form
                , table = layui.table
                , layer = layui.layer
                , $ = layui.jquery;


            // 刷新
            $('#btn-refresh').on('click', function () {
                location.reload();
            });


            // you code ...

            //编辑
            $('.layui-edit').on('click',function(){
                var id = $(this).attr('name');
                layer.open({
                    type: 2,
                    title: '修改权限路由目录',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['500px', '350px'],
                    content: '/admin/permissions/'+id+'/edit',
                });
            }),


            //删除
            $('.layui-del').on('click',function(){
                var id = $(this).attr('name');
                $.ajax({
                    url: '/admin/roles/'+id,
                    dataType:"json",
                    type:'post',
                    method:'delete',
                    data:'',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        layer.msg(data.msg);
                        setTimeout(function(){
                            location.reload();
                        },2000);
                    },
                    error:function(){
                        layer.msg('网络错误')
                    }
                });
            });




        });
    </script>

@stop
