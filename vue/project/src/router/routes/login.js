import login from '@/pages/login/index'


let routes = [
	{
		path : '/login' ,
		name : 'login' ,
		component : login ,
		meta : {
			'lv': 6 ,
			'auth' : false ,
		}
	}


]

export default routes ;


