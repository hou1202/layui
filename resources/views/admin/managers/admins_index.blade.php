@extends('admin.layouts._iframe_default')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/admin/frame/static/css/list.css">
@stop

@section('content')

    <!-- 工具集 -->
    <div class="my-btn-box">
        <span class="fl">
            <a class="layui-btn layui-btn-danger radius btn-delect" id="btn-delete-all">批量删除</a>
            <a class="layui-btn btn-add btn-default" id="btn-add" href="{{ route('admins.create') }}">添加</a>
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
    <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1">
        <table cellspacing="0" cellpadding="0" border="0" class="layui-table layui-table-custom">
            <thead>
            <tr>
                <th class="layui-body-cell-4">ID</th>
                <th>用户名</th>
                <th>权限组</th>
                <th>状态</th>
                <th>最后登录时间</th>
                <th>最后登录IP</th>
                <th>创建时间</th>
                <th class="layui-body-cell-3">操作</th>
            </tr>
            </thead>
            <tbody class="layui-tbody">
            @foreach( $admins as $admin)
                <tr>
                    <td class="layui-body-cell-4">{{ $admin->id }}</td>
                    <td>{{ $admin->account }}</td>
                    <td>{{ $admin->role_name }}</td>
                    <td>
                        @if($admin->is_super || $admin->id == Auth::guard('admin')->User()->id)
                            <div class="layui-unselect layui-form-switch layui-form-onswitch" >
                                <i></i>
                            </div>
                        @else
                        <input type="hidden" value="{{ $admin->status }}" name="status" />
                        <input type="hidden" value="{{ $admin->id }}" name="id" />
                        <div class="layui_status layui-unselect layui-form-switch @if($admin->status != Null) layui-form-onswitch @endif " >
                            <i></i>
                        </div>
                        @endif
                    </td>
                    <td>{{ $admin->last_at }}</td>
                    <td>{{ $admin->last_ip }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td class="layui-body-cell-3">
                        <div class="">
                            <a class="layui-btn layui-btn-mini" lay-event="detail" href="{{ route('admins.show',$admin->id) }}">
                                <i class="layui-icon">&#xe628;</i>查看
                            </a>
                            @if(!$admin->is_super && !Auth::guard('admin')->User()->is_super ||Auth::guard('admin')->User()->is_super)
                                <a class="layui-btn layui-btn-mini layui-btn-normal layui-edit"  lay-event="edit" href="{{ route('admins.edit',$admin->id) }}">
                                    <i class="layui-icon">&#xe642;</i>编辑
                                </a>
                            @endif
                            @if(!$admin->is_super && $admin->id != Auth::guard('admin')->User()->id)
                                <a class="layui-btn layui-btn-mini layui-btn-danger layui-del"  lay-event="del" name="{{ $admin->id }}">
                                    <i class="layui-icon">&#xe640;</i>删除
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

        {{--表格底部分页--}}
        <div class="layui-table-tool">
            <div class="layui-inline layui-table-page" id="layui-table-page1">
                <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
                    {!! $admins -> render() !!}
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
                , vipTable = layui.vip_table
                , $ = layui.jquery;


            // 刷新
            $('#btn-refresh').on('click', function () {
                //tableIns.reload();
                location.reload();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // you code ...
            //更新管理员状态
            $('.layui_status').on('click',function(){
                var id = $(this).prev().val();
                var status = $(this).prev().prev().val();

                $(this).toggleClass("layui-form-onswitch");
                $.ajax({
                    url:'{{ route('admins.status') }}',
                    dataType:"json",
                    type:"post",
                    data:{"id":id,"status":status},
                    success:function(data){
                        layer.msg(data.msg);
                    },
                    error:function(){
                        layer.msg('网络错误')
                    }
                });
            });

            //删除
            $('.layui-del').on('click',function(){
                var id = $(this).attr('name');
                $.ajax({
                    url: '/admin/admins/'+id,
                    dataType:"json",
                    type:'post',
                    method:'delete',
                    data:'',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        layer.msg(data.msg);
                        if(data.code == 1){
                            setTimeout(function(){
                                location.reload();
                            },2000);
                        }
                    },
                    error:function(){
                        layer.msg('网络错误')
                    }
                });
            });




        });

    </script>

@stop
