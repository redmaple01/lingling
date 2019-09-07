import work from '@/pages/member/work'
import mywork from '@/pages/member/mywork'
import member from '@/pages/member/index'


let routes = [
	{
		path : '/work' ,
		name : 'work' ,
		component : work ,
		meta : {
			'lv': 2 ,
			'auth' : true ,
		}
	},
	{
		path : '/member' ,
		name : 'member' ,
		component : member ,
		meta : {
			'lv': 4 ,
			'auth' : true ,
		}
	},
	{
		path : '/mywork' ,
		name : 'mywork' ,
		component : mywork ,
		meta : {
			'lv': 5 ,
			'auth' : true ,
		}
	}


]

export default routes ;


