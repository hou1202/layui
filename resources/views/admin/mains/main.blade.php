@extends('admin.layouts.default')

@section('content')
    <!-- layout admin -->
    <div class="layui-layout layui-layout-admin"> <!-- 添加skin-1类可手动修改主题为纯白，添加skin-2类可手动修改主题为蓝白 -->

        <!-- header -->
        <div class="layui-header my-header">
            <a href="index.html">
                <img class="my-header-logo" src="/admin/frame/static/image/logo.png" alt="logo">
                <div class="my-header-logo">AOZOM管理后台</div>
            </a>
            <div class="my-header-btn">
                <button class="layui-btn layui-btn-small btn-nav"><i class="layui-icon">&#xe65f;</i></button>
            </div>

            <!-- 顶部左侧添加选项卡监听-->
            <!-- <ul class="layui-nav" lay-filter="side-top-left">
                <li class="layui-nav-item"><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe621;</i>基础</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                        <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                    </dl>
                </li>
            </ul>-->

            <!-- 顶部右侧添加选项卡监听 -->
            <ul class="layui-nav my-header-user-nav" lay-filter="side-top-right">

                <li class="layui-nav-item">
                    <a class="name" href="javascript:;"><img src="/admin/frame/static/image/head.jpg" alt="logo"> {{ Auth::guard('admin')->User()->account }} </a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" href-url="demo/login.html"><i class="layui-icon">&#xe621;</i>登录页</a></dd>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <dd>
                                <a>
                                    <i class="layui-icon">&#x1006;</i>
                                    <button class="logout-button" type="submit" name="button">退出</button>
                                </a>
                            </dd>
                        </form>
                    </dl>
                </li>
            </ul>

        </div>

        <!-- side -->
        <div class="layui-side my-side">
            <div class="layui-side-scroll">
                <!-- 左侧主菜单添加选项卡监听 -->
                <ul class="layui-nav layui-nav-tree" lay-filter="side-main">
                    <li class="layui-nav-item  layui-nav-itemed">
                        <a href="javascript:;"><i class="layui-icon">&#xe620;</i>管理设置</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="{{ route( 'managers.index' ) }}"><i class="layui-icon">&#xe621;</i>管理员管理</a></dd>
                            <dd><a href="javascript:;" href-url="{{ route( 'permissions.index' ) }}"><i class="layui-icon">&#xe621;</i>权限管理</a></dd>
                            <dd><a href="javascript:;" href-url="{{ route( 'roles.index' ) }}"><i class="layui-icon">&#xe621;</i>角色管理</a></dd>
                            <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                        </dl>
                    </li>

                    <li class="layui-nav-item  layui-nav-itemed">
                        <a href="javascript:;"><i class="layui-icon">&#xe620;</i>基础</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                            <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item  layui-nav-itemed">
                        <a href="javascript:;"><i class="layui-icon">&#xe620;</i>设置</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                            <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                         </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;"><i class="layui-icon">&#xe628;</i>扩展</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="demo/login.html"><i class="layui-icon">&#xe621;</i>登录页</a></dd>
                            <dd><a href="javascript:;" href-url="demo/register.html"><i class="layui-icon">&#xe621;</i>注册页</a></dd>
                       </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" href-url="demo/user.html"><i class="layui-icon">&#xe628;</i>用户管理</a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;"><i class="layui-icon">&#xe628;</i>用户管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="demo/user.html"><i class="layui-icon">&#xe621;</i>用户管理页</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item"><a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=ad6ba602ae228be2222ddb804086e0cfa42da3d74e34b383b665c2bec1adfc6e"><i class="layui-icon">&#xe61e;</i>加入群下载源码</a></li>
                </ul>

            </div>
        </div>

        <!-- body -->
        <div class="layui-body my-body">
            <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="1"><span><i class="layui-icon">&#xe638;</i>主页</span></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe id="iframe" src="{{ route('admin.welcome') }}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <div class="layui-footer my-footer">
            <div class="main-bottom-own">Aozom@版权所有</div>
        </div>
    </div>


    <!-- 右键菜单 -->
    <div class="my-dblclick-box none">
        <table class="layui-tab dblclick-tab">
            <tr class="card-refresh">
                <td><i class="layui-icon">&#x1002;</i>刷新当前标签</td>
            </tr>
            <tr class="card-close">
                <td><i class="layui-icon">&#x1006;</i>关闭当前标签</td>
            </tr>
            <tr class="card-close-all">
                <td><i class="layui-icon">&#x1006;</i>关闭所有标签</td>
            </tr>
        </table>
    </div>
@stop

@section('javascript')
    <script type="text/javascript" src="/admin/frame/static/js/vip_comm.js"></script>
    <script type="text/javascript">
        layui.use(['layer','vip_nav'], function () {

            // 操作对象
            var layer       = layui.layer
                ,vipNav     = layui.vip_nav
                ,$          = layui.jquery;

            // 顶部左侧菜单生成 [请求地址,过滤ID,是否展开,携带参数]
            vipNav.top_left('/admin/json/nav_top_left.json','side-top-left',false);
            // 主体菜单生成 [请求地址,过滤ID,是否展开,携带参数]
            vipNav.main('/admin/json/nav_main.json','side-main',true);

            // you code ...

        });
    </script>
@stop



