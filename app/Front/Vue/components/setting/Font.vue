<template>
    <div>
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-10">
                    <div class="margin-top-5 margin-left-10"@click="onCommonBack">
                        <img src="images/back.png"width="85%;" style="margin-top:-3px;">
                    </div>
                </div>
                <div class="col-55 margin-top-4" style="float: right;">
                    <span v-language="'Font size'">文字サイズ</span>
                </div>
            </div>
        </div>

        <div class="row margin-top-40">
            <div class="col-26 col-offset-6">
                <div :class="{'border-all-gray':isFontOff1,'bg-button':isFontOn1}" class="text-center" target="1" @click="onSend" style="padding:15px 0;">小</div>
            </div>

            <div class="col-offset-6 col-26">
                <div :class="{'border-all-gray':isFontOff2, 'bg-button':isFontOn2}" class="text-center" target="2" @click="onSend" style="padding:15px 0;">中</div>
            </div>

            <div class="col-offset-6 col-26">
                <div :class="{'border-all-gray':isFontOff3, 'bg-button':isFontOn3}" class="text-center" target="3" @click="onSend" style="padding:15px 0;">大</div>
            </div>

        </div>
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue"
    import UserClass from "../../http/UserClass";
    import UserValidate from "../../validate/UserValidate";


    @Component
    export default class extends Mixins<Base>(Base){
        public form:any = {}

        public isFontOff1:boolean = true
        public isFontOn1:boolean = false
        public isFontOff2:boolean = true
        public isFontOn2:boolean = false
        public isFontOff3:boolean = true
        public isFontOn3:boolean = false

        public created() :void
        {
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            let $UserClass = new UserClass()

            eval("this.isFontOn" + $UserClass.user.font + " = true")

            this.screen()
        }
        /**
         *  更新
         **/
        public async onSend(eventHandle:any)
        {
            let $UserClass = new UserClass()
            $UserClass.user.font = eventHandle.target.getAttribute("target")
            $UserClass.updateStorage()

            this.isFontOn1 = false
            this.isFontOn2 = false
            this.isFontOn3 = false


            eval("this.isFontOn" + $UserClass.user.font + " = true")

            this.screenFont()

            $UserClass.isLoading = false
            await $UserClass.update({font:$UserClass.user.font})

        }



    }


</script>
