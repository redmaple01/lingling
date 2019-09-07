<template>
    <div>
        <div class="m-login">
            <a @click="toback()"><i class="iconfont">&#xe646;</i></a>

            <img src="@/assets/images/logo.png" />
            <input type="text" placeholder="输入手机号"  v-model="mobile" />
            <input type="password" placeholder="输入密码" v-model="password" />
       
            <button class="m-btn" @click="login()">登录</button>

            
         
        </div>  
    </div>
</template>
<style scoped>
    
    .m-login{ position: absolute; width: 100%; height: 100%; background:#fff; }
    .m-login a{ display: block; width: 40px; height: 40px; position: absolute; top: 0; right: 0; }
    .m-login a i{ display: block; width: 40px; height: 40px; line-height: 40px; text-align: center;font-size: 1.2em; }

    .m-login img{ width: 80px; display: block; margin: 10% auto ; }

    .m-login input{ display: block; margin: 0 auto; width: 80%; height: 50px; line-height: 50px; border:0; border-bottom: 1px solid #efefef; font-size: .85em; font-weight: 500; font-family:PingFangSC-Light; border-radius: 0; }

    .m-login p{ line-height: 30px; font-size: .75em; text-align: right ; margin-right: 35px; color: #666; }
    .m-login p a{ color: #444; }

    .m-login-b{ position: absolute; width: 100%; height: 60px; left: 0; bottom: 0; }
    .m-login-b p{ line-height: 16px; font-size: .75em; text-align: center; color: #999; }


    .m-other{ padding: 20px; text-align: center; font-size: .85em; color: #666; }

</style>



<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { login } from '@/api/index' 


export default{

    data(){
        return {
            mobile: '13915700170' ,
            password: '123456' ,
            back : this.$route.query.redirect
        }

    },
    created(){
        // console.log(this.back)

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

