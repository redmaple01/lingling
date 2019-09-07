<template>
  <div id="app">

    <transition :name="transitionName">
        <router-view :class="{ 'm-view' : is_fixed == true }"></router-view>
    </transition>

  </div>
</template>



<style stoped>
  .m-view{ position: fixed; top:0; bottom:0; left: 0; right: 0; width: 100%; height: 100%; background: #f3f3f3 ;overflow: scroll; }

</style>


<script>

import store from '@/store/store'
export default {
  name: 'App',
  data() {
    return {
        transitionName : '' ,

        is_fixed : true ,

    }
  },
  created () {

  },
  methods : {


  },
  watch : {

    '$route' (to, from) {

        //切换
        if(to.name === 'login'){
            this.transitionName = 'slide-up'
        }else if(from.name === 'login'){
            this.transitionName = 'slide-down'
        }else{

          let tolv = to.meta.lv
          let fromlv = from.meta.lv

          if(tolv == fromlv){
            this.transitionName = 'slide-show'
          }else{
            this.transitionName = tolv > fromlv ? 'fold-left' : 'fold-right'
          }
        }

        //fixed 处理
        if(to.name === 'lupay'){
          this.is_fixed = false 
        }else if(from.name === 'lupay'){
          this.is_fixed = true
        }

    },


  },
  components: {

  }

}
</script>
