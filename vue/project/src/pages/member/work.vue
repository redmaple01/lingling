<template>
    <div>

    	<div class="m-top">
    		铃铃用人
    	</div>


        <div class="m-input mt10">
            <p class="a"><i class="iconfont">&#xe65f;</i></p>
            <p class="b">用人时间 <strong>{{work_time}}</strong> <span class="m-right"><strong @click="changeTime()">修改</strong> <i class="iconfont">&#xe6a3;</i></span></p>
        </div> 


        <div class="m-input mt10">
            <p class="a"><i class="iconfont">&#xe651;</i></p>
            <p class="b">{{address}} <span class="m-right" @click="getAddress()"><i class="iconfont">&#xe6a3;</i></span></p>
        </div> 
        <div class="m-input">
            <p class="a"></p>
            <p class="b"><input type="text" placeholder="请输入手机" v-model="mobile" /></p>
        </div>
        <div class="m-input">
            <p class="a"></p>
            <p class="b"><input type="text" placeholder="请输入姓名" v-model="name" /></p>
        </div>

        <div class="m-input">
            <p class="a"><i class="iconfont">&#xe7d1;</i></p>
            <p class="b"><input type="text" placeholder="加小费" v-model="gratuity" /></p>
        </div>

        <div class="m-input mt10">
            <p class="a"><i class="iconfont">&#xe6af;</i></p>
            <p class="b">起步价 <strong>50</strong>元/2小时 , 超出加收 <strong>20</strong>元/小时</p>
        </div>
        <div class="m-input">
            <p class="a"><i class="iconfont">&#xe6bc;</i></p>
            <p class="b"><input type="text" placeholder="备注" v-model="summary" /></p>
        </div>

        <button class="m-btn" @click="save()">提交订单</button>


        <Nav :ishome="ishome" ></Nav>


    </div>
</template>
<style scoped>
    	
    .m-top{ background: var(--c); color: #fff; text-align: center; height: 40px; line-height: 40px; }


	.m-input{ background: #fff; display: flex;  }
	.m-input p.a{ flex: 1 ; text-align: center; }
	.m-input p.b{ flex: 6 ; padding-right: 10px; border-bottom: 1px solid #f3f3f3; color: #999 }
	.m-input p{ line-height: 40px; height: 40px; font-size: .85em;}
	.m-input strong{ font-weight: 500; color: var(--c) }
	.m-input input{ font-size: 1em; color: #444; font-family: PingFangSC-Light; border:0; height: 40px; line-height: 40px; width: 90%; }


</style>



<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { setOrder } from '@/api/index' 
import Nav from '@/components/nav'


export default{

    data(){
        return {
        	ishome : true ,
            work_time: '现在' ,
            province: '浙江' ,
            city : '杭州' ,
            county : '余航' ,
            address: '定位中...' ,
            gratuity: '' ,
            name : '' ,
            mobile : '' ,
            summary : '' ,

        }

    },
    created(){
        // console.log(this.back)

    },
    methods: {
        save(){



            let params = {
                mobile : this.mobile ,
                name : this.name ,
                work_time : this.work_time ,
                address : this.address ,
                province : this.province ,
                city : this.city ,
                county : this.county ,
                summary : this.summary ,
            }

            Indicator.open()
            return new Promise((resolve,reject) => {
                setOrder(params).then(response => {
                    Indicator.close()
                    console.log(response)
                    if(response.code == 1){

                        this.$router.push({'path':'/mywork'})


                    }else{
                        Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })
        },
  
  		changeTime(){
  			Toast('择日不如撞日！下单去吧！');
  		},
  		getAddress(){
  			this.address = '浙江省余杭区高教路998-5号楼'
            Toast('获取定位成功！');
            this.mobile = 13222210338 
            this.name = '黄先生'
            this.gratuity = Math.ceil(Math.random()*10) 
            this.summary = '保洁服务'


  		}

    },
    components: {
    	Nav ,
    }

}



</script>

