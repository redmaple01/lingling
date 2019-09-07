import stafforder from '@/pages/staff/order'
import staffmyorder from '@/pages/staff/myorder'
import stafflogin from '@/pages/staff/login'
import staff from '@/pages/staff/index'


let routes = [
	{
		path : '/staff' ,
		name : 'staff' ,
		component : staff ,
		meta : {
			'lv': 4 ,
			'auth' : true ,
		}
	},
	{
		path : '/stafforder' ,
		name : 'stafforder' ,
		component : stafforder ,
		meta : {
			'lv': 2 ,
			'auth' : true ,
		}
	},
	{
		path : '/staffmyorder' ,
		name : 'staffmyorder' ,
		component : staffmyorder ,
		meta : {
			'lv': 5 ,
			'auth' : true ,
		}
	},
	{
		path : '/stafflogin' ,
		name : 'stafflogin' ,
		component : stafflogin ,
		meta : {
			'lv': 7 ,
			'auth' : false ,
		}
	}

]

export default routes ;


