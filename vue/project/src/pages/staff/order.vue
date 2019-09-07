<template>
    <div>

    	<div class="m-top">
    		所有订单
    	</div>

    	<div class="m-input">
            <p class="a"><i class="iconfont">&#xe65f;</i></p>
            <p class="b">设置接单 <span class="m-right"><strong @click="workSet()" v-show="!work_status" style="color:green">开启</strong><strong @click="workSet()" v-show="work_status">关闭</strong></span></p>
        </div> 

        <audio class="success"
		    src="/static/m.mp3">
		</audio>

        <ul class="m-list">

            <li v-for="(item, index) in list">
                <h3>用人时间: <strong>{{item.work_time|formatTime}}</strong> </h3>
                <p><span>地点: </span>{{item.province}}{{item.city}}{{item.county}}{{item.address}} <br>
                    <span>备注: </span> {{item.summary}} <br>
                    <span>状态: </span> <strong>{{item.status|status}}</strong></p>

                <a @click="save(index)" v-if="item.status == 0">立即抢单</a>
            </li>

        </ul>

        <Nav :ishome="ishome" ></Nav>





    </div>
</template>
<style scoped>
    	
    .m-top{ background: var(--c); color: #fff; text-align: center; height: 40px; line-height: 40px; }
    .m-top span{ width: 40px; height: 40px; position: absolute; top: 0; left: 0;  }

    .m-list li{ background: #fff; padding: 10px; margin-top: 10px; position: relative; }
    .m-list h3{ line-height: 20px; font-size: .85em; }
    .m-list p{ line-height: 20px; font-size: .75em; }
    .m-list p span{ color: #666; }
    .m-list strong{ color: var(--c); font-weight: 500; }
    .m-list a{ height: 20px; padding: 3px 10px; font-size: .75em; background: var(--c); color: #fff; border-radius: 15px; position: absolute; bottom: 10px ; right: 10px; }


    	.m-input{ background: #fff; display: flex;  }
	.m-input p.a{ flex: 1 ; text-align: center; }
	.m-input p.b{ flex: 6 ; padding-right: 10px; border-bottom: 1px solid #f3f3f3; color: #999 }
	.m-input p{ line-height: 40px; height: 40px; font-size: .85em;}
	.m-input strong{ font-weight: 500; color: var(--c) }
	.m-input input{ font-size: 1em; color: #444; font-family: PingFangSC-Light;border:0; height: 40px; line-height: 40px; width: 90%;  }

</style>



<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { getOrder, setStaffOrder } from '@/api/staff' 
import Nav from '@/components/nav2'


export default{

    data(){
        return {
        	ishome : true ,
            list : [] ,
            work_status : false ,

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
                getOrder(params).then(response => {
                    Indicator.close()
                    console.log(response)
                    if(response.code == 1){
                        this.list = response.data
                    }else{
                    	this.list = []
                        // Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })
        },
        back(){
            this.$router.back()
        },
        save(v){

        	let _that = this
        	let id = this.list[v].id  ;

        	let params = {
            	work_id : id
            }

            Indicator.open()
            return new Promise((resolve,reject) => {
                setStaffOrder(params).then(response => {
                    Indicator.close()
                    // console.log(response)
                    if(response.code == 1){
                    	Toast('抢单成功！')
                    	setTimeout(function(){
                        	_that.getOrder()
                    	},2000)
                    }else{
                        Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })


        },
        workSet(){
        	this.work_status ? this.work_status = false : this.work_status = true ;
        },
        //测试代码 增加订单
        lunxun(){

        	if(this.work_status){
        		let more = this.list[0]
        		let _that = this

        		setInterval(function(){
        			_that.list.push(more)
        		},5000)

        	}


        }
  

    },
    components: {
    	Nav ,
    },
    filters:{
        status: function (v){
            return v == 0 ? '排队中' : '已接单' ;
        },
        formatTime (v) {
        let a = new Date(v*1000)
        let m = a.getMonth()+1
        return a.getFullYear() + '/' + m + '/' + a.getDate()

      }
    },
    watch : {
        work_status (news,old) {
            
        	console.log(news)
        	this.lunxun()

        },
    }

}



</script>

