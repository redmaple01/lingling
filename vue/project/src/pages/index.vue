<template>
    <div>
        <div class="m-index">

            <router-link to="/work" tag="a">会员入口</router-link>

            <router-link to="/stafflogin" tag="a">工作者入口</router-link>

        </div>  
    </div>
</template>
<style scoped>
        
    .m-index{ background: #fff; text-align: center;  }
    .m-index a{ display: block; line-height: 50px;  }

</style>


<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { login } from '@/api/index' 


export default{

    data(){
        return {
            mobile: '' ,
            password: '' ,
            back : this.$route.query.redirect
        }

    },
    created(){

        store.commit('logout')

    },
    methods: {
        login(){

            let params = {
                mobile : this.mobile ,
                userpass : this.password ,
            }

            Indicator.open()
            return new Promise((resolve,reject) => {
                login(params).then(response => {
                    Indicator.close()
                    console.log(response)
                    if(response.code == 1){
                        store.commit('login', response.data.token )
                        store.commit('user', response.data )

                        Toast(response.msg)

                        let url = this.$route.query.redirect 
                        if(!url){
                            url = '/'
                        }
                        this.$router.push({'path':url})
                        this.password = ''
                    }else{
                        Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })
        },
        toback() {
            this.$router.push({'path': '/'})
        }

    },
    components: {

    }

}



</script>

