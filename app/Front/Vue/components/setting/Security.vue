<template>
    <div>
        <Dialog message="更新が完了しました" title="完了" ref="dialogEnd" />
        <Dialog message="" title="エラー" ref="dialogError" />

        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Setting'">設定</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>
　　　　<div class="row">
            <div class="mainfont2 col-100 margin-top-10">
                <div class="text-center margin-top-5">
                    <span v-language="'Password Reset'">パスワードの再設定</span>
                </div>
            </div>
         </div>

        <div class="row">
            <div class="mainfont titleline col-100 margin-top-8">
                <div class="text-center">
                        <Input
                            :name="'password'"
                            :type="'password'"
                            :placeholder="'Password'"
                            :styles="'position: relative; box-sizing: border-box;display: inline-block;padding: 0px 27px ;border-radius: 3px;padding-top:1.5px;padding-bottom: 1.5px;overflow:                 hidden;width: 70%;background: #f0f4f9;'"
                        />

                 </div>
            </div>

            <div class="col-100 margin-top-35 text-center mainfont margin-bottom-40">
                <button type="button"class="find-btnpink" @click="onSend">Update</button>
            </div>
        </div>
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue"
    import Input from "../layouts/editors/Input.vue";
    import Error from "../layouts/editors/Error.vue";
    import UserClass from "../../http/UserClass";
    import ToolClass from "../../liblary/ToolClass";
    import Dialog from "../layouts/Dialog.vue";
    import UserValidate from "../../validate/UserValidate";

    @Component({
        components: {
            Input,
            Dialog,
            Error,
        },
    })

    export default class extends Mixins<Base>(Base){
        public form:any = {}

        public isUserName:boolean = false
        public isTel:boolean = false
        public isEmail:boolean = false
        public isImage:boolean = false

        private action:string = ""

        public created() :void
        {

        }

        /**
         *  更新
         **/
        public async onSend()
        {
            let $UserClass = new UserClass()

            let $UserValidate = new UserValidate()
            let error:any = $UserValidate.validates["password"]

            $UserValidate.validates = {}
            $UserValidate.validates["password"] = error

            if ($UserValidate.getError(this,this.form)){
                await $UserClass.update(this.form)
                this.refs().dialogEnd.show()
            }else{
                for (let key in $UserValidate.errorMessages){
                    this.refs().dialogError.setMessage($UserValidate.errorMessages[key])
                }

                this.refs().dialogError.show()
            }

        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

    }


</script>
