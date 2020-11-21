<template>

    <div>
       <div class="logoaction">
          <img src="images/logo2.svg"/>
      </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import UserClass from "../http/UserClass";
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import LanguageClass from "../http/LanguageClass";

    @Component({

    })

    export default class Index extends Mixins<Base>(Base){
        public isAuth:boolean = false

        public async created()
        {
            let self = this

            let $UserClass = new UserClass()
            $UserClass.isLoading = false
            $UserClass.auth(function(){
                //言語読み込み
                let $LanguageClass = new LanguageClass()
                $LanguageClass.get(function(){
                    if ($UserClass.user){
                        self.$router.push({name:window.env.FRONT_TOP})
                    }else{
                        self.$router.push({name:"login"})
                    }
                })


            })
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() : void
        {
            this.screen({isHeader:false, isFooter:false})
        }
    }


</script>
