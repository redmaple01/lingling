<?php
namespace app\api\controller ;

use think\Controller ;
use app\common\libs\Token ;
use think\Db ;

class Base extends Controller
{

	const SUCCESS_CODE = 1 ;
	const ERROR_CODE = 0 ;


	public function initialize(){



	}


	public function login(){

		if($this->request->method() == 'POST'){

			$mobile = $this->request->param('mobile') ;
			$userpass = $this->request->param('userpass') ;

			$data = Db::name('member') -> where( ['mobile' => $mobile] ) -> find() ;
			if(!$data){
				return $this->renderError('账户不存在！');
			}else{
				//token
				// $token = new Token() ;
				// token有问题
				$data['token'] = $data['id']; //$token->getToken($data['id']) ;

				return $data['userpass'] == passMd5($userpass,$data['usercode']) ? $this -> renderSuccess($data) : $this -> renderError('账号或密码不正确！');
			}
		}

	}


	public function staffLogin(){

		if($this->request->method() == 'POST'){

			$mobile = $this->request->param('mobile') ;
			$userpass = $this->request->param('userpass') ;

			$data = Db::name('staff') -> where( ['mobile' => $mobile] ) -> find() ;


			if(!$data){
				return $this->renderError('账户不存在！');
			}else{
				//token
				// $options['key'] = '123456';
				// $token = new Token($options) ;
				// 同时生产token有问题
				$data['token'] = $data['id'] ; //$token->getToken($data['id']) ;

				return $data['userpass'] == passMd5($userpass,$data['usercode']) ? $this -> renderSuccess($data) : $this -> renderError('账号或密码不正确！');
			}
		}

	}

	//统一返回
	public function renderJson( $code=self::SUCCESS_CODE , $msg='' , $data=[] ){
		return json(compact('code' , 'msg' , 'data'));
	}
	//正确返回
	public function renderSuccess( $data=[] , $msg='success' ){
		return $this->renderJson( self::SUCCESS_CODE , $msg , $data ) ;
	}
	//错误返回
	public function renderError( $msg='error', $data=[] ){
		return $this->renderJson( self::ERROR_CODE , $msg , $data ) ;
	}






}