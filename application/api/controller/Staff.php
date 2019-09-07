<?php
namespace app\api\controller ;

use think\Controller ;
use app\common\libs\Token ;
use think\Db ;

class Staff extends Base
{


	public static $_member ;

	public function initialize(){

		$this -> checkToken();

	}

	public function checkToken(){
		$token = $this->request->header('Token');
		if($token){
			// $options['key']= '123456' ;
			// $obj= new Token($options);
			// $data = $obj->checkToken($token);
			// $data = json_decode(json_encode($data),true);
			self::$_member = Db::name('staff') -> where( ['id'=>$token] ) -> find();
		}else{
			return $this->renderError('token null');
		}
	}


	public function order(){
		if($this->request->method() == 'GET'){

			$list = Db::name('work') -> where( ['status'=>0] )  -> order('id desc') -> select();
			return $list ? $this -> renderSuccess($list) : $this->renderError('null') ;

		}


	}


	public function staffOrder(){

		if($this->request->method() == 'POST'){

			// Db::startTrans();

			$param = $this->request->param();
			$param['staff_id'] = self::$_member['id'];
			$param['create_time'] = time();

			$param['bn'] = 'D'.date('YmdHis').rand(100,999);

			$re = Db::name('order') -> insert($param);

			if($re){
				$sql = 'update tp_work set status = 1 where id='.$param['work_id'] ;
				$re2 = Db::execute($sql);
			// 	Db::commit();
				return  $this -> renderSuccess($re);
			}else{
			// 	Db::rollback();
				return  $this->renderError('提交失败！') ;
			}

		}

		if($this->request->method() == 'GET'){

			$list = Db::name('order') 
					-> alias('a') 
					-> field('a.* , b.work_time, b.province, b.city, b.county, b.address')
					-> join('tp_work b', 'b.id = a.work_id')
					-> where( ['a.status'=>0] )
					-> order('a.id desc')
					-> select();
			return $list ? $this -> renderSuccess($list) : $this->renderError('null') ;

		}


	}




}