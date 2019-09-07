<template>
    <div>

    	<div class="m-member">
    		<img src="@/assets/images/user.png" />
    		<h3>{{member.name}}</h3>
            <p>余额: ¥ 0.00</p>
    	</div>

    	 <div class="m-input mt10">
            <p class="a"><i class="iconfont">&#xe699;</i></p>
            <p class="b" @click="go()">我接的单子 <span class="m-right"><i class="iconfont">&#xe6a3;</i></span></p>
        </div> 

        <div class="m-input mt10">
            <p class="a"><i class="iconfont">&#xe7cb;</i></p>
            <p class="b" @click="logout()">退出 <span class="m-right"><i class="iconfont">&#xe6a3;</i></span></p>
        </div> 


        <Nav :ismy="ismy" ></Nav>


    </div>
</template>
<style scoped>
    	

  	.m-member{ text-align: center; background: var(--c); padding: 30px  }
  	.m-member img{ width: 80px; height: 80px; border-radius: 40px; }
  	.m-member h3{ line-height: 20px; font-size: .85em; color: #fff; }
    .m-member p { font-size: .75em; color: #fff; }

	.m-input{ background: #fff; display: flex;  }
	.m-input p.a{ flex: 1 ; text-align: center; }
	.m-input p.b{ flex: 6 ; padding-right: 10px; border-bottom: 1px solid #f3f3f3; color: #999 }
	.m-input p{ line-height: 40px; height: 40px; font-size: .85em;}
	.m-input strong{ font-weight: 500; color: var(--c) }
	.m-input input{ font-size: 1em; color: #444; font-family: PingFangSC-Light }


</style>



<script>


import { Toast, Indicator, Buttom } from 'mint-ui'
import store from '@/store/store'
import { setOrder } from '@/api/index' 
import Nav from '@/components/nav2'


export default{

    data(){
        return {
        	ismy : true ,
            member : store.state.user ,

        }

    },
    created(){
        console.log(this.member)

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
            }

            Indicator.open()
            return new Promise((resolve,reject) => {
                setOrder(params).then(response => {
                    Indicator.close()
                    console.log(response)
                    if(response.status == 1){

                    }else{
                        Toast(response.msg)
                    }
                  
                    resolve()   //执行状态改变
                }).catch(error=>{
                    reject(error)    //抛出错误
                })
            })
        },
  
  		logout(){
  			store.commit('logout')
			this.$router.push({ 'path': '/stafflogin' })
  		},
  		go(){
  			this.$router.push({ 'path': '/staffmyorder' })
  		}


    },
    components: {
    	Nav ,
    }

}



</script>

