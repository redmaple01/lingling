<?php
namespace app\api\controller ;

use think\Controller ;
use app\common\libs\Token ;
use think\Db ;

class Index extends Base
{

	const SUCCESS_CODE = 1 ;
	const ERROR_CODE = 0 ;


	public static $_member ;

	public function initialize(){

		$this -> checkToken();

	}

	public function index(){
		echo '404 error' ;
	}

	public function checkToken(){
		$token = $this->request->header('Token');
		if($token){
			// $obj= new Token();
			// $data = $obj->checkToken($token);
			// $data = json_decode(json_encode($data),true);
			self::$_member = Db::name('member') -> where( ['id'=>$token ] ) -> find();
		}else{
			return $this->renderError('token null');
		}
	}


	public function order(){

		if($this->request->method() == 'POST'){

			$param = $this->request->param();
			$param['member_id'] = self::$_member['id'];

			if($param['work_time'] == '现在'){
				$param['work_time'] = time();
			}

			$re = Db::name('work') -> insert($param);
			return $re ? $this -> renderSuccess($re) : $this->renderError('提交失败！') ;

		}

		if($this->request->method() == 'GET'){

			$list = Db::name('work') -> where( ['member_id'=>self::$_member['id'] ] ) -> order('id desc') -> select();
			return $list ? $this -> renderSuccess($list) : $this->renderError('提交失败！') ;

		}


	}




}