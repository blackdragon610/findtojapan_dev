<template>
    <div>
       <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Frequently Asked Questions'">よくある質問</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>

　　　<div class="row" v-for="(type, key) in types" @click="onDetail" :target="key">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        {{type}}
                    </div>
                </div>
                <div class="col-49">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>
</div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";


    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public types:any = {}

        public created() :void
        {
            this.types = window.configs.qa_type

            this.screen()
        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {

        }

        public onDetail(eventHandle:any) : void
        {
            this.$router.push({name:"question_detail", query:{target:eventHandle.currentTarget.getAttribute("target")}})

        }
    }


</script>
