<template>
    <div>
        
        <div class="m-nav">
          <div v-show="!ishome" class="a" @click="tohome()">
            <i class="iconfont">&#xe6b8;</i>
            <p>首页</p>
          </div>
          <div v-show="ishome" @click="tohome()">
            <i class="iconfont">&#xe6bb;</i>
            <p>首页</p>
          </div>


          <div v-show="!ismy" class="a" @click="tomy()">
            <i class="iconfont">&#xe736;</i>
            <p>我的</p>
          </div>
          <div v-show="ismy" @click="tomy()">
            <i class="iconfont">&#xe735;</i>
            <p>我的</p>
          </div>

        </div>


    </div>
</template>

<style scoped>
    
    .m-nav{ height: 55px; display: flex; position: fixed; bottom: 0; left: 0; width: 100%; background: #fff; z-index: 100; }
    .m-nav div{ flex: 1 ; text-align: center; }
    .m-nav div i{ width: 25px; height: 25px; display: block; font-size: 1.4em; margin:5px auto 0; color: var(--c) }
    .m-nav div p{ line-height: 20px; font-size: .75em; color: var(--c) }
    .m-nav .a i{ color: #999; }
    .m-nav .a p{ color: #999; }

</style>


<script>


export default {
    props: ['ishome', 'ismy'] ,
    date () {
        return {
        }
    },
    created () {

    },
    methods: {
      tohome() {
        this.$router.push({'path':'/stafforder' })
      },
      tomy() {
        this.$router.push({'path':'/staff' })
      }
    },


}
</script>