<template>
    <div>

        <div id="login"> 　
            <Dialog message="シークレットコードが違います" title="エラー" ref="dialogError" />

            <div class="container">
                <div class="row">
                    <div class="col-100 margin-top-20 text-center">
                        <div class="fixedheader">
                            <div class="findicon">
                                <img src="images/loginlogo.png"width="60%">
                            </div>
                        </div>
                    </div>


                    メールアドレスに届いたシークレットコードを入力してください。
                    <div class="mainfont2 col-100 margin-top-10">
                        <div class="text-center margin-top-5">
                            <span>シークレットコード</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mainfont col-100 margin-top-8">
                        <div class="text-center">
                            <div method="get"  class="acount_container"> <img src="images/mail.png"style="margin-top:-2px!important;">
                                <Input
                                    ref="secret"
                                    :type="'text'"
                                    :placeholder="'シークレットコード'"
                                    :styles="'font-size: 14px;margin-top: 1.7px;'"
                                />
                            </div>

                        </div>
                    </div>

                    <div class="col-100 margin-top-35 text-center mainfont margin-bottom-40">
                        <button type="button"class="find-btnpink" @click="onSend">Send</button>
                    </div>

                    <div class="margin-top-15 text-center mainfont">
                        <button type="button"class="find-btn" style="font-wegiht: 600!important;" @click="onCommonBack">BACK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue"
    import UserClass from "../http/UserClass";
    import Input from "./layouts/editors/Input.vue";
    import Dialog from "./layouts/Dialog.vue";


    @Component({
        components: {
            Input,
            Dialog,
        },
    })

    export default class extends Mixins<Base>(Base){
        public form:any = {}
        public isAuth:boolean = false
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
            /*let $UserClass = new UserClass()

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
            }*/

            this.refs().dialogError.show()
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen({isHeader:false, isFooter:false})
        }

    }


</script>
