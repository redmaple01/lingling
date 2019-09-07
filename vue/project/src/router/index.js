import Vue from 'vue'
import Router from 'vue-router'

import index from '@/pages/index' 



Vue.use(Router)

//引入
import login from '@/router/routes/login.js'
import staff from '@/router/routes/staff.js'
import member from '@/router/routes/member.js'



const baseRoutes = [

    {
      path: '/',
      redirect : '/index'
    },
    {
		path : '/index' ,
		name : 'index' ,
		component : index ,
		meta : {
			'lv': 1 ,
			'auth' : false ,
		}
	}

]

const routes = baseRoutes.concat(login, staff, member ) ;

export default new Router({
	base: '/',                //路由前缀
  	mode: "history",          //隐藏路由#号
  	routes,

})
