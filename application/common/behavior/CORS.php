<?php

namespace app\common\behavior;


/**
 * 前置操作 【前后端分离跨域处理】
 * Class CORS
 * @package app\api\behavior
 */

class CORS
{
    public function appInit()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Token, Origin, X-Requested-With, Content-Type, Accept, Authorization, AppId");
        header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');

        if(request()->isOptions()){
            exit();
        }
    }
}