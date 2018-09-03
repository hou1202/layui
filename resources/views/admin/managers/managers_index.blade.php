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
            <a class="layui-btn btn-add btn-default" id="btn-add" href="{{ route('managers.create') }}">添加</a>
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
    <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" height:416px;">
        <div class="layui-table-header">
            {{--表格头部标题--}}
            <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                <thead>
                <tr>

                    <th>
                        <div class="layui-table-cell laytable-cell-1-id">
                            <span>ID</span>
                        </div></th>
                    <th>
                        <div class="layui-table-cell laytable-cell-1-account">
                            <span>用户名</span>
                        </div></th>
                    <th>
                        <div class="layui-table-cell laytable-cell-1-auth_group_name">
                            <span>权限组</span>
                        </div></th>
                    <th>
                        <div class="layui-table-cell laytable-cell-1-account">
                            <span>状态</span>
                        </div></th>
                    <th data-field="last_login_time">
                        <div class="layui-table-cell laytable-cell-1-last_login_time">
                            <span>最后登录时间</span>
                        </div></th>
                    <th data-field="last_login_ip">
                        <div class="layui-table-cell laytable-cell-1-last_login_ip">
                            <span>最后登录IP</span>
                        </div></th>
                    <th data-field="create_time">
                        <div class="layui-table-cell laytable-cell-1-create_time">
                            <span>创建时间</span>
                        </div></th>
                    <th data-field="8">
                        <div class="layui-table-cell laytable-cell-1-8" align="center">
                            <span>操作</span>
                        </div></th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="layui-table-body layui-table-main" style="height: 335px;">
            {{--表格数据--}}
            <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                <tbody>
                @foreach( $managers as $manager)
                <tr data-index="0" class="">

                    <td data-field="id">
                        <div class="layui-table-cell laytable-cell-1-id">
                            {{ $manager->id }}
                        </div></td>
                    <td data-field="account">
                        <div class="layui-table-cell laytable-cell-1-account">
                            {{ $manager->account }}
                        </div></td>
                    <td data-field="auth_group_name">
                        <div class="layui-table-cell laytable-cell-1-auth_group_name">
                            {{ $manager->role_id }}
                        </div></td>
                    <td data-field="status">
                        <div class="layui-table-cell laytable-cell-1-account">
                            <input type="hidden" value="{{ $manager->status }}" name="status" />
                            <input type="hidden" value="{{ $manager->id }}" name="id" />
                            <div class="layui-unselect layui-form-switch @if($manager->status != Null) layui-form-onswitch @endif " >
                                <i></i>
                            </div>

                        </div></td>
                    <td data-field="last_login_time">
                        <div class="layui-table-cell laytable-cell-1-last_login_time">
                            {{ $manager->last_at }}
                        </div></td>
                    <td data-field="last_login_ip">
                        <div class="layui-table-cell laytable-cell-1-last_login_ip">
                            {{ $manager->last_ip }}
                        </div></td>
                    <td data-field="create_time">
                        <div class="layui-table-cell laytable-cell-1-create_time">
                            {{ $manager->created_at }}
                        </div></td>
                    <td data-field="8" align="center" data-off="true">
                        <div class="layui-table-cell laytable-cell-1-8">
                            <a class="layui-btn layui-btn-mini" lay-event="detail">查看</a>
                            <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="edit">编辑</a>
                            <a class="layui-btn layui-btn-mini layui-btn-danger" lay-event="del">删除</a>
                        </div></td>
                </tr>
                @endforeach


                </tbody>
            </table>
        </div>
       <div class="layui-table-fixed layui-table-fixed-r layui-hide" style="right: 16px;">
            <div class="layui-table-header">
                <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                    <thead>
                    <tr>
                        <th data-field="8">
                            <div class="layui-table-cell laytable-cell-1-8" align="center">
                                <span>操作</span>
                            </div></th>
                    </tr>
                    </thead>
                </table>
                <div class="layui-table-mend"></div>
            </div>

        </div>

        {{--表格底部分页--}}
        <div class="layui-table-tool">
            <div class="layui-inline layui-table-page" id="layui-table-page1">
                <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
                    {!! $managers -> render() !!}
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

            // 表格渲染
           /* var tableIns = table.render({
                elem: '#dateTable'                  //指定原始表格元素选择器（推荐id选择器）
                , height: vipTable.getFullHeight()    //容器高度
                , cols: [[                  //标题栏
                    {checkbox: true, sort: true, fixed: true, space: true}
                    , {field: 'id', title: 'ID', width: 80}
                    , {field: 'account', title: '用户名', width: 120}
                    , {field: 'auth_group_name', title: '权限组', width: 120}
                    , {field: 'last_login_time', title: '最后登录时间', width: 180}
                    , {field: 'last_login_ip', title: '最后登录IP', width: 180}
                    , {field: 'create_time', title: '创建时间', width: 180}
                    , {field: 'status', title: '状态', width: 70}
                    , {fixed: 'right', title: '操作', width: 150, align: 'center', toolbar: '#barOption'} //这里的toolbar值是模板元素的选择器
                ]]
                , id: 'dataCheck'
                , url: 'http://web.layui.com/admin/json/data_table.json'
                , method: 'get'
                , page: true
                , limits: [30, 60, 90, 150, 300]
                , limit: 30 //默认采用30
                , loading: false
                , done: function (res, curr, count) {
                    //如果是异步请求数据方式，res即为你接口返回的信息。
                    //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
                    console.log(res);

                    //得到当前页码
                    console.log(curr);

                    //得到数据总量
                    console.log(count);
                }
            });*/


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
            $('.layui-unselect').on('click',function(){
                var id = $(this).prev().val();
                var status = $(this).prev().prev().val();

                $(this).toggleClass("layui-form-onswitch");
                $.ajax({
                    url:'{{ route('managers.status') }}',
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
            })

        });
    </script>
    <!-- 表格操作按钮集 -->
    <script type="text/html" id="barOption">
        <a class="layui-btn layui-btn-mini" lay-event="detail">查看</a>
        <a class="layui-btn layui-btn-mini layui-btn-normal" lay-event="edit">编辑</a>
        <a class="layui-btn layui-btn-mini layui-btn-danger" lay-event="del">删除</a>
    </script>
@stop
