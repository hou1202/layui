**Laravel —— HOU 学习笔记**

一 、 GIT 分支操作

   $ git checkout master
   
    切换到master主分支 。 [ master 是在初始化Git时默认创建的主分支 ]
    
   $ git checkout -b static-pages
   
    创建一个新分支，分支名为: static-pages [ -b 指定新创建的分支名 ]
    
   $ git merge fake-branch
   
    合并分支
    
   $ get branch -d fake-branch
   
    删除分支
    
二、路由

    路由：定义 URL 和 URL 的请求方式。
   1、位置
   
        路由文件一般位于 routes 目录下，目录下已经提供多个路由文件，PHP项目一般使用 web.php 文件
        基本形式：
            Route::get('/',function(){
                //
            });
            Route::get('/','IndexController@index')->name('index');
    
   2、路由基本操作：

        GET         常用于页面读取
        POST        常用于数据提交
        PATCH       常用于数据更新
        DELETE      常用于数据删除
        
        备注：PATCH 和 DELETE 是不被浏览器所支持的，但可以通过隐藏域来提交。
        
   3、资源路由
   
        新增的 resource 方法将遵从 RESTful 架构为用户资源生成路由。该方法接收两个参数，第一个参数为资源名称，第二个参数为控制器名称。
        Route::resource('users','UsersController');
            等同于同时生成
        Route::get('/users','UsersController@index')->name('users.index');
        Route::get('/users/{user}','UsersController@show')->name('users.show');
        Route::get('/users/create','UsersController@create')->name('users.create');
        Route::post('/users','UsersController@store')->name('users.store');
        Route::get('/users/{user}/edit','UsersController@edit')->name('users.edit');
        Route::patch('/users/{user}','UsersController@udpate')->name('users.update');
        Route::delete('/users/{user}','UsersController@destroy')->name('users.destroy');
        
        生成的资源路由列表信息如下所示：
        
        HTTP        请求	URL	                    动作  	                    作用
        GET	        /users	            UsersController@index	    显示所有用户列表的页面
        GET	        /users/{user}	    UsersController@show	    显示用户个人信息的页面
        GET	        /users/create	    UsersController@create	    创建用户的页面
        POST	    /users	            UsersController@store	    创建用户
        GET	        /users/{user}/edit	UsersController@edit	    编辑用户个人资料的页面
        PATCH	    /users/{user}	    UsersController@update	    更新用户
        DELETE	    /users/{user}	    UsersController@destroy     删除用户
        

三、控制器

    Laravel的控制器命名规范统一采用 [ 驼峰式大小写 ] 和 [ 复数 ] 形式来命名。
   1、控制器位置：
   
        控制器所在目录一般位于：
        app/Http/Controllers`
        
   2、artisan 生成控制器
   
        $ php artisan make:controller StaticPagesController
        
   3、视图渲染
   
        return view();
        view();方法接收两个参数：第一个参数是视力的路径；第二个参数是与视图绑定的数据。
        
   4、
    
四、视图

    在Laravel中，视图文件存放于resources/views下；
    在Laravel中，视图文件的命名后缀规定使用： .blade.php 。
    
   1、模板继承
   
        4.1.1、定义父模板
            layouts/default.blade.php [名称自定义]
        4.1.2、区域占位
            @yield('title','default-value');
            yield方法提供两个参数，第一个参数为占位区域的名称，第二个参数，为非必选项，是占位区域的默认值。
        4.1.3、子模板继承
            @extends('layouts.default')    
            继承父模板视图
            在Laravel中，目录和文件中的链接是用 . 号，而不是 / 号。
        4.1.4、子模板填充
            @section('title','value');
            
            @section('content')
                //  
            @stop
            如果在父模板中定义了@yield的第二个参数[ 默认值 ] ，在子模板填充时@section()，可以不用@stop结束；
            
   2、局部视图
   
        将模板中的某一块区域单独提取，并建立成公共文件
        4.2.1、命名
            _header.blade.php
            在局部视图的命名规则中，约定，文件名以 _ 开头，再加文件名
        4.2.2、引入
            @include('layouts._header')
            
   3、链接优化
   
        {{route('name)}}
        通过Laravel提供的route()方法，来传递一个具体的路由名称来生成完整的URL。
        在定义路由规则时，需要定义路由别名
        
   4、模板解析
   
        {{ $title }}
            转义输出  [ 将一段html代码只是被当成普通的字符串输出 ]
        {!! $title !!}
            原生输出  [ 一段html代码可以被正常的解析 ]
            
            
五、Artisan命令

    php artisan list 
    查看所有artisan命令
    php artisan help migrate
    通过 help 查看 Artisan 命令帮助
    
   基础Arisan命令
   
        php artisan key:generate                生成 App Key
        php artisan make:controller             生成控制器
        php artisan make:model                  生成模型
        php artisan make:policy                 生成授权策略
        php artisan make:seeder                 生成 Seeder 文件
        php artisan migrate                     生成迁移
        php artisan migrate:rollback            回滚迁移
        php artisan migrate:refresh             重置数据库
        php artisan db:seed                     填充数据库
        php artisan thinker                     进入 thinker 环境
        php artisan route:list                  查看路由列表
           
六、模型

   1、位置
   
        系统默认模型文件放在 app 目录下，可自定义生成到 Models 下
   2、命名
   
        在约定中，模型的名称一般采用相对应表名称的单数形式来名称
   3、$tbale \ $fillable \ $hidden
   
        6.3.1、protected $table = 'users';
        手动指定该模型所对应的数据表
        6.3.2、protected $fillable = ['name','email'];
        过滤用户提交字段时，指定可被更新的字段
        6.3.3、protected $hidden = ['password','remember_token'];
        对敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
        
   4、生成模型文件
   
        php artisan make:model Models/User -m
        参数 -m 或者 -migration 为在创建模型文件的同时，生成迁移文件
        


七、数据库

    数据迁移
    
    
   CRUD操作
   
        新建
            Laravel新建/保存新数据的方法主要有：create、insert、save、insertGetId
            create
                创建成功后会返回一个用户对象，并包含新注册用户的所有信息
            save
                创建成功后会返回一个为true的布尔值，否则返回false
            insert
                创建成功后会返回一个为true的布尔值，否则返回false
            insertGetId
                创建成功后会返回新注册用户的自增ID
    
    
八、杂项
    
   1、添加语言包
   
        Laravel 为消息验证的多语言提供了一种非常简便的方法进行支持。我们可以通过添加一个如 resources/lang/xx/validation.php 语言包，并在语言包的 custom 数组中对翻译语言进行设定
        GitHub 上有人专门为此写了一个扩展包 - overtrue/laravel-lang 来对 Laravel 提供默认提示信息添加多语言版本翻译。
        $ composer require "overtrue/laravel-lang:~3.0"     
        
        将项目语言设置为中文：config/app.php     
        <?php
            return [
                .
                'locale' => 'zh-CN',
                .
            ];
   2、授权策略
   
        策略文件位于app下面的Policies文件下[默认情况下文件是并没有创建的]
        生成策略文件
            $php artisan make:policy UserPolicy
        
        创建策略 [ 例 ]
            public function update(User $currentUser,User $user){
                return $currentUser->id === $user->id;
            }
            update 方法接收两个参数，第一个参数默认为当前登录用户实例，第二个参数则为要进行授权的用户实例。当两个 id 相同时，则代表两个用户是相同用户，用户通过授权，可以接着进行下一个操作。
            
        策略配置
            AuthServiceProvider 包含了一个 policies 属性，该属性用于将各种模型对应到管理它们的授权策略上。
            app/Providers/AuthServiceProvider.php
            
            protected $policies = [
                    'App\Model' => 'App\Policies\ModelPolicy',
                    \App\Models\User::class  => \App\Policies\UserPolicy::class,
            ];
            
        使用策略
            $this -> authorize('update',$user);
            authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据
            在相应需要使用授权策略的方法中，加入相应的策略即可
            
        模板策略
            Laravel授权策略提供了 @can Blade命令，允许我们在Blade模板中做授权判断
            @can ('update',$user)
                //
            @endcan
   3、友好转向
   
        intended（）
        redirect() 实例提供了的一个方法，该方法可将页面重定向到上一次请求尝试访问的页面上，并接收一个默认跳转地址参数，当上一次请求记录为空时，跳转到默认地址上。
        return redirect()->intended(route('routename'));
   4、注册与登录访问限制
   
        4.1、通过Auth中间件的auth属性来对控制器进行动作过滤；
        4.2、通过Auth中间件的guest选项，用于指定一些只允许未通过用户进行的访问动作。
            SessionsController.php
            public function __ construct()
            {
                $this -> middleware('guest',[
                    'only'=>['create']
                ]);
            }
            //只让未登录用户访问create路由页面
            默认会跳转到Laravel指定的/home页面，也可自行对redirect()中间件的调用方法进行修改，并返回提示
            app/Http/Middleware/RedirectIfAuthenticated.php
            
            public function handle($request, Closure $next, $guard = null)
                {
                    if (Auth::guard($guard)->check()) {
                        session()->flash('info', '您已登录，无需再次操作。');
                        return redirect('/');
                    }
                }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        