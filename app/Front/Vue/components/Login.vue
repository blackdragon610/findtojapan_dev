<template>
    <div class="container" id="login">

        <form method="post">
            <div class="row">
               <div class="col-100 margin-top-20 text-center">
                <div class="fixedheader">
                  <div class="findicon">
                       <img src="images/loginlogo.png"width="60%">
                  </div>
                 </div>
              </div>
                <div class="col-100 margin-top-40 text-center subfont" v-language="'Sign in'">
                    Sign in
                </div>

                <div class="col-75 margin-top-35 margin-left-40">
                    <div class="acount_container"> <img src="images/pass.png">
                        <img src="images/mail.png" style="margin-top:-2px!important;">
                        <Input
                            ref="email"
                            :type="'email'"
                            :placeholder="'Email'"
                            :styles="'font-size: 14px;margin-top: 1.7px;'"
                        />
                    </div>
                </div>
                <div class="col-75 margin-top-10 margin-left-40">
                    <div class="acount_container"> <img src="images/pass.png">
                        <img src="images/pass.png">

                        <Input
                            ref="password"
                            :type="'password'"
                            :placeholder = "'Password'"
                            :styles="'font-size: 14px;margin-top: 1.7px;'"
                        />
                    </div>
                </div>

                <div class="col-100 margin-top-45 text-center mainfont" style="font-size: 14px;" @click="onReminder">
                    <span v-language="'Forgot password'">Forgot password?</span>
                </div>




                  <div class="col-100 margin-top-35 text-center mainfont margin-bottom-40">
                     <button type="button" class="find-btnpink" @click="onSubmit" v-language="'SIGN IN'">SIGN IN</button>

                      <!--
                      <div class="text-center">
                          <ul class="padding-top-10">
                              <li class="width-64 btn-sns facebook margin-top-10"><img src="images/facebook.png" @click="onFacebook" /></li>
                              <li class="width-64 btn-sns twitter margin-top-5"><img src="images/twitter.png" /></li>
                          </ul>
                      </div>
                      -->
                  </div>

                  <div class="col-100 margin-top-15 text-center mainfont margin-bottom-40">
                      <button type="button"class="find-btn" style="font-wegiht: 600!important;" @click="onSignup" v-language="'SIGN UP'">SIGN UP</button>
                  </div>
              </div>
        </form>
    </div>
</template>


<script lang="ts">

    /**
     * ログイン
     */
    import Component from "vue-class-component"
    import Input from "./layouts/editors/Input.vue"
    import Base from "./Base.vue";
    import {Mixins} from "vue-mixin-decorator";
    import UserClass from "../http/UserClass";
    import router from "../router";
    import StorageClass from "../liblary/StorageClass";
    import FormClass from "../liblary/FormClass";

    @Component({
        components: {
            Input,
        },
    })

    export default class Login extends Mixins<Base>(Base){
        public isAuth:boolean = false
        public form:any = {}

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen({isHeader:false, isFooter:false})

        }

        /**
         *  ログイン
         */
        public async onSubmit()
        {
            let $UserClass = new UserClass()

            let $FormClass = new FormClass()
            let datas = $FormClass.get(this.refs())

            try {
                let result: string = await $UserClass.login(datas.email, datas.password)

                if (result == "OK") {
                    try {
                        await $UserClass.auth()
                        this.$router.push({name: "find"})
                    } catch (e) {

                    }


                } else {
                    alert("ログイン情報に間違いがあります")
                }
            }catch (e) {

            }
        }

        public onFacebook()
        {
            //let win:any = window.open(window.env.APP_URL + "/api/sns/fb", '_self')
            let win:any = window.open("https://google.com", '_blank', 'location=yes')



            win.addEventListener("loadstop", function(){
                alert("W")
            })
            win.executeScript({code: "alert('Hello Ionic!');"})


        }
        public onSignup()
        {
            this.$router.push({name:"member"})
        }

        /**
         * パスワードを忘れた方
         */
        public onReminder()
        {
            this.$router.push({name:"reminder"})
        }

    }


</script>
