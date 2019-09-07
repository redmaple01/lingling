<?php
namespace app\common\libs ;

use app\common\exception\BaseException ;
use \Firebase\JWT\JWT;

Class Token {
	
	const TOKEN_KEY = 'abc' ;


	public function __construct($options=[]){
		if(array_key_exists('key', $options)){
			$this->TOKEN_KEY=$options['key'];
		}

	}



	//获取token
	public function getToken($id){
		if(!$id){
			throw new BaseException( ['msg'=>'缺少参数:member_id' ] ) ;
		}

		$key = self::TOKEN_KEY ;  //这里是自定义的一个随机字串，应该写在config文件中的，解密时也会用，相当    于加密中常用的 盐  salt
        $token = [
            "iss"=>"",  //签发者 可以为空
            "aud"=>"", //面象的用户，可以为空
            "iat" => time(), //签发时间
            "nbf" => time()+100, //在什么时候jwt开始生效  （这里表示生成100秒后才生效）
            "exp" => time()+100, //token 过期时间
            "uid" => $id //记录的userid的信息，这里是自已添加上去的，如果有其它信息，可以再添加数组的键值对
        ];
        $jwt = JWT::encode($token,$key,"HS256"); //根据参数生成了 token
        return $jwt;
	}

	//验证token
	public function checkToken($token){
         $info = JWT::decode($token,self::TOKEN_KEY,["HS256"]); //解密jwt
    	return $info ;
	}



	
}