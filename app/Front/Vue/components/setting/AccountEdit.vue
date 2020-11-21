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
                    <span v-language="'Setting'">設定</span>
                </div>
            <div class="col-20"></div>
            </div>
        </div>

         <div class="row">
            <div class="mainfont2 col-100 margin-top-10">
                <div class="text-center margin-top-5">
                    ユーザー名
                </div>
            </div>
         </div>
           <div class="row">
            <div class="mainfont titleline col-100 margin-top-5" v-show="isUserName">
                <div class="text-center">
                        <Input
                            ref="user_name"
                            :type="'text'"
                            :placeholder="'Full Name'"
                            :styles="'padding: 0px 17px ; border-radius: 5px; height: 25px; width: 75%;  background: #f0f4f9; box-sizing: border-box; display: inline-block;'"
                        />


                </div>
            </div>
　　　　
            <div class="mainfont titleline col-100 margin-top-5" v-show="isTel">
                <div class="text-center">

                    <Input
                        ref="tel"
                        :type="'tel'"
                        :placeholder="'Tel'"
                        :styles="'padding: 0px 17px ; border-radius: 5px; height: 25px; width: 75%;  background: #f0f4f9; box-sizing: border-box; display: inline-block;'"
                    />

                </div>

            </div>

            <div class="mainfont titleline margin-top-5" v-show="isEmail">
                <div class="margin-left-15">
                    メールアドレス
                </div>
                <div class="text-center">
                     <Input
                        ref="email"
                        :type="'email'"
                        :placeholder="'Email'"
                        :styles="'padding: 0px 17px ; border-radius: 5px; height: 25px; width: 75%;  background: #f0f4f9; box-sizing: border-box; display: inline-block;'"
                    />
                </div>
            </div>

            <div class="mainfont titleline col-100 margin-top-5" v-show="isImage">
                <div class="col-20">
                    <div class="margin-left-15">
                        <FileDialog ref="image" ></FileDialog>
                    </div>
                </div>
            </div>

            <div class="col-100 margin-top-35 text-center mainfont margin-bottom-40">
                <button type="button"class="find-btnpink" @click="onSend" v-language="'Update'">Update</button>
            </div>
        </div>
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue"
    import Input from "../layouts/editors/Input.vue";
    import FileDialog from "../layouts/editors/FileDialog.vue";
    import Error from "../layouts/editors/Error.vue";
    import UserClass from "../../http/UserClass";
    import ToolClass from "../../liblary/ToolClass";
    import Dialog from "../layouts/Dialog.vue";
    import UserEditValidate from "../../validate/UserEditValidate";
    import FormClass from "../../liblary/FormClass";

    @Component({
        components: {
            Input,
            FileDialog,
            Dialog,
            Error,
        },
    })

    export default class extends Mixins<Base>(Base){
        public isUserName:boolean = false
        public isTel:boolean = false
        public isEmail:boolean = false
        public isImage:boolean = false

        private action:string = ""

        public created() :void
        {
            //this.$route.query.action = "image"

            this.action = String(this.$route.query.action)

            let $ToolClass = new ToolClass()
            var actionBig:string = $ToolClass.changeSnakeToCamel(this.action)
            actionBig = actionBig.substring(0, 1).toUpperCase()  + actionBig.substring(1)


            eval("this.is" + actionBig + "=true")

        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()

            let $UserClass = new UserClass()
            let $FormClass = new FormClass()

            $FormClass.set($UserClass.user, this.refs())
        }

        /**
         *  更新
         **/
        public async onSend()
        {
            let $UserClass = new UserClass()
            var data:any = {}

            let $FormClass = new FormClass()
            let datas = $FormClass.get(this.refs())

            data[this.action] = datas[this.action]

            let $UserEditValidate = new UserEditValidate()
            let error:any = $UserEditValidate.validates[this.action]

            $UserEditValidate.validates = {}
            $UserEditValidate.validates[this.action] = error

            var isErrorEmail:boolean = true

            if (this.action == "email"){
                let isOk = await $UserClass.emailCheck(data.email)

                if (!isOk){
                    isErrorEmail = false
                }
            }

            if (($UserEditValidate.getError(this,data)) && (isErrorEmail)){
                await $UserClass.update(data)
                this.refs().dialogEnd.show()
            }else{
                for (let key in $UserEditValidate.errorMessages){
                    this.refs().dialogError.setMessage($UserEditValidate.errorMessages[key])
                }

                if (!isErrorEmail){
                    this.refs().dialogError.setMessage("他のユーザーが使用しているメールアドレスです")
                }

                this.refs().dialogError.show()
            }

        }


    }


</script>
