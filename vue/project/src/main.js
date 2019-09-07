import 'babel-polyfill'
import Vue from 'vue'
import App from './App'
import router from './router'

import axios from 'axios'
import FastClick from 'fastclick'
import store from './store/store'

//加载公共样式
import '@/assets/css/style.css'

//加载mint-ui
import MintUI from 'mint-ui'
import 'mint-ui/lib/style.css'
Vue.use(MintUI)

import VueSocketio from 'vue-socket.io';
import socketio from 'socket.io-client';

// Vue.use(VueSocketio, socketio('0.0.0.0:8881'));


// 页面刷新时，重新赋值token

if (window.localStorage.getItem('token')) {
  store.commit('login',window.localStorage.getItem('token') )
}

if (window.localStorage.getItem('user')) {
  store.commit('user',JSON.parse(window.localStorage.getItem('user')) )
}

router.beforeEach((to, from, next) => {

	// console.log(to.meta.auth)

	// 登录系统
	if(to.meta.auth){
		console.log(store.state.token)

	  if (store.state.token.length < 1) {
	     next({
	       path: '/login',
	       query: {redirect: to.fullPath}  // 将跳转的路由path作为参数，登录成功后跳转到该路由
	     })
	  }
	}

	/* 路由发生变化修改页面title */
	if (to.meta.title) {
		document.title = to.meta.title
	}

  	next()

})


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
