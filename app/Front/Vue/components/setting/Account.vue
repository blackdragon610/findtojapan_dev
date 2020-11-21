<template>
    <div>
      <div class="row">
        <div class="mainfont titleline col-100">
	       <div class="col-20">
                <div class="margin-top-5 margin-left-12" @click="onCommonBack">
                  <img src="images/back.png"width="24%;" style="margin-top:1px;">
                </div>
           </div>
          <div class="col-60  text-center margin-top-2">
	          ログイン
          </div>
          <div class="col-20"></div>
        </div>
    </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16" @click="onAccountEdit" target="user_name">
                        ユーザー名
                    </div>
                </div>
                <div class="col-67">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>

         <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-32 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16" @click="onAccountEdit" target="tel">
                        電話番号
                    </div>
                </div>
                <div class="col-65">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>

           <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-35 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16" @click="onAccountEdit" target="email">
                        メールアドレス
                    </div>
                </div>
                <div class="col-64">
                    <img src="images/ing.png"width="10%;" style="float: right; margin-right:8px; margin-top:1px;">
                </div>
            </div>
        </div>
   </div>
 </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue"

    @Component({

    })

    export default class extends Mixins<Base>(Base){

        public created() :void
        {

        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        public onAccountEdit(eventHandle:any) : void
        {

            this.$router.push({ name: 'account_edit', query: {action:eventHandle.target.getAttribute("target")}})

        }

    }


</script>
