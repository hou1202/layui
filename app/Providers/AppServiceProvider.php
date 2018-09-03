<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * 自定义验证规则
         */
        /*
         * length       验证是否为指定长度
         *
         * */
        Validator::extend('length',function($attribute,$value,$parameters){
           return mb_strlen(trim($value),'UTF8') == $parameters[0];
        });

        /*
         * Null default     若为NULL，则设置默认值
         *
         * @return  true
         * */
        Validator::extend('Null default',function($attribute,$value,$parameters){
            if($value === null){
                return $value = $parameters[0];
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
