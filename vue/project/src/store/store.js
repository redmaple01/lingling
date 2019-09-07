import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex);

//状态树
const state = {
    token : '',
    user : '' ,


}

//修改state值的方法树 通过 store.commit()
const mutations = {

    login: (state, data) => {
            localStorage.token = data
            localStorage.tokenTime = parseInt((new Date()).valueOf()) + 7200000 ;
            state.token = data;
        },
    logout: (state) => {
        localStorage.removeItem('token')
        localStorage.removeItem('tokenTime')
        localStorage.removeItem('user')
        state.token = ''
        state.user = ''
    },
    user: (state, data) => {
            state.user = data;
            localStorage.user = JSON.stringify(data)
    },

}

//类似mutations 并提交到mutations 单可异步
const actions = {

}

//计算方法 依赖state
const getters = {

}


//配置A
const moduleA = {
    state : {

    },
    mutations : {

    },
    actions : {

    },
    getters : {

    }
}

//配置B
const moduleB = {
    state : {

    },
    mutations : {

    },
    actions : {

    },
    getters : {

    }
}


export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
    modules : {
        a : moduleA ,
        b : moduleB
    }
})