<template>
    <div>

    	<div class="m-top">
            <span @click="back()"><i class="iconfont">&#xe679;</i></span>
    		我接的订单
    	</div>

        <ul class="m-list">

            <li v-for="(item, index) in list">
                <h3>订单编号: <strong>{{item.bn}}</strong> </h3>
                <p><span>地点: </span>{{item.province}}{{item.city}}{{item.county}}{{item.address}} <br>
                    <span>时间: </span> {{item.create_time|formatTime}} <br>
                    <span>状态: </span> <strong>{{item.status|status}}</strong></p>
            </li>

        </ul>


    </div>
</template>
<style scoped>
    	
    .m-top{ background: var(--c); color: #fff; text-align: center; height: 40px; line-height: 40px; }
    .m-top span{ width: 40px; height: 40px; position: absolute; top: 0; left: 0;  }

    .m-list li{ background: #fff; padding: 10px; margin-top: 10px; }
    .m-list h3{ line-height: 20px; font-size: .85em; }
    .m-list p{ line-height: 20px; font-size: .75em; }
    .m-list p span{ color: #666; }
    .m-list strong{ color: var(--c); font-weight: 500; }

</style>



<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { getStaffOrder } from '@/api/staff' 


export default{

    data(){
        return {
            list : [] ,

        }

    },
    created(){
        this.getOrder()

    },
    methods: {
        getOrder(){

            let params = {
            }

            Indicator.open()
            return new Promise((resolve,reject) => {
                getStaffOrder(params).then(response => {
                    Indicator.close()
                    console.log(response)
                    if(response.code == 1){
                        this.list = response.data
                    }else{
                        Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })
        },
        back(){
            this.$router.back()
        }
  

    },
    components: {
    },
    filters:{
        status: function (v){
            return v == 0 ? '未服务' : '已服务' ;
        },
        formatTime (v) {
        let a = new Date(v*1000)
        let m = a.getMonth()+1
        return a.getFullYear() + '/' + m + '/' + a.getDate()

      }
    },

}



</script>

