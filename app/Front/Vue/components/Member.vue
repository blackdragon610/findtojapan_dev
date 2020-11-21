<template>
    <div id="login"> 　

        <div class="container">

            <div class="row">
                <div class="col-100 margin-top-20 text-center">
                  <div class="fixedheader">
                  <div class="findicon">
                       <img src="images/loginlogo.png"width="60%">
                  </div>
                 </div>                </div>
                <div class="col-100 margin-top-40 text-center subfont">
                    <span v-language="'Create Account'">Create Account</span>
                </div>

                <div class="col-75 margin-top-35 margin-left-40">
                    <div method="get"  class="acount_container">
                        <img src="images/name.png">
                        <Input
                            ref="user_name"
                            :type="'text'"
                            :placeholder="'Full Name'"
                            :styles="'font-size: 14px;margin-top: 1.7px;'"
                        />

                    </div>
                    <Error ref="error_user_name" />
                </div>
                <div class="col-75 margin-top-10 margin-left-40">
                    <div method="get"  class="acount_container"> <img src="images/mail.png"style="margin-top:-2px!important;">
                        <Input
                            ref="email"
                            :type="'email'"
                            :placeholder="'Email'"
                            :styles="'font-size: 14px;margin-top: 1.7px;'"
                        />
                    </div>
                    <Error ref="error_email" />
                </div>
                <div class="col-75 margin-top-10 margin-left-40">
                    <div method="get"  class="acount_container"> <img src="images/pass.png">
                        <Input
                            ref="password"
                            :type="'password'"
                            :placeholder="'Password'"
                            :styles="'font-size: 14px;margin-top: 1.7px;'"
                        />
                    </div>
                    <Error ref="error_password" />
                </div>


                <div class="col-100 margin-top-70 text-center mainfont margin-bottom-40">
                    <button type="button" class="find-btnpink" v-on:click="onSubmit">CREATE</button>
                </div>

                <div class="margin-top-15 text-center mainfont">
                    <button type="button"class="find-btn" style="font-wegiht: 600!important;" @click="onCommonBack">BACK</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script lang="ts">

    /**
     * 会員登録
     */
    import Component from "vue-class-component"
    import Input from "./layouts/editors/Input.vue"
    import Error from "./layouts/editors/Error.vue"
    import Base from "./Base.vue";
    import {Mixins} from "vue-mixin-decorator";
    import UserValidate from "../validate/UserValidate";
    import UserClass from "../http/UserClass";
    import router from "../router";
    import FormClass from "../liblary/FormClass";

    @Component({
        components: {
            Input,
            Error,
        },
    })

    export default class extends Mixins<Base>(Base){
        public isAuth:boolean = false


        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen({isHeader:false, isFooter:false})
        }

        /**
         *  登録
         */
        public async onSubmit()
        {
            //エラーチェック
            let $UserValidate = new UserValidate()

            let $FormClass = new FormClass()
            let datas:any = $FormClass.get(this.refs())

            if ($UserValidate.getError(this,datas)){
                let $UserClass = new UserClass()
                let result:any = await $UserClass.save(datas)


                if (result.result == "NG"){
                    //既に登録済みのメールアドレス
                    this.refs().error_email.$emit("error", {message:"既に登録済みのメールアドレスです"})
                }else{
                    await $UserClass.login(datas.email, datas.password)

                    let self = this
                    $UserClass.auth(function(){
                        self.$router.push({name:"find"})
                    })

                }
            }
        }



    }


</script>
