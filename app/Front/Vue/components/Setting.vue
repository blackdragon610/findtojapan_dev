<template>
    <div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-5">
                <div class="col-25">
                    <div class="margin-left-15">
                        <span v-language="'Account'">アカウント</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onAccount">
                <div class="col-44 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Confirmation and change of ID etc.'">IDなどの確認と変更</span>
                    </div>
                </div>
                <div class="col-56 margin-top-2 margin-bottom-2">

                    <img src="images/ing.png"width="11%;" style="float: right; margin-right:10.5px;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onSecurity">
                <div class="col-38 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Change Password'">パスワード変更</span>
                    </div>
                </div>
                <div class="col-60 margin-top-2 margin-bottom-2">
                    <img src="images/ing.png"width="10.5%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>



        <div class="row">
            <div class="mainfont2 titleline col-100">
                <div class="col-20">
                    <div class="margin-left-15 margin-top-13">
                        <span v-language="'Notification'">通知</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Push'">プッシュ</span>
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <div class="switch"style="float: right;">
                        <label class="switch3__label">
                            <input type="checkbox" class="switch3__input" v-model="is_push" target="is_push" @change="changeNotification" />
                            <span class="switch3__content"></span>
                            <span class="switch3__circle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Badge'">バッヂ</span>
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <div class="switch"style="float: right;">
                        <label class="switch3__label">
                            <input type="checkbox" class="switch3__input" v-model="is_badge" target="is_badge" @change="changeNotification" />
                            <span class="switch3__content"></span>
                            <span class="switch3__circle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Mail'">メール</span>
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <div class="switch"style="float: right;">
                        <label class="switch3__label">
                            <input type="checkbox" class="switch3__input" v-model="is_email" target="is_email" @change="changeNotification" />
                            <span class="switch3__content"></span>
                            <span class="switch3__circle"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        　
        <div class="row">
            <div class="mainfont2 titleline col-100">
                <div class="col-20">
                    <div class="margin-left-13 margin-top-13">
                        <span v-language="'View'">表示</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onFont">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Character size'">文字の大きさ</span>
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onLanguage">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Language'">言語</span>
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>

        <!--
        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        画面表示
                    </div>
                </div>
                <div class="col-67 margin-top-2 margin-bottom-2">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>
        -->

        <!--
        <div class="row">
            <div class="mainfont2 titleline col-100">
                <div class="col-20">
                    <div class="margin-left-12 margin-top-13">
                        サウンド
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-30 margin-top-4 margin-bottom-2">
                    <div class="margin-left-16">
                        効果音
                    </div>
                </div>
                <div class="col-67">
                    <img src="images/ing.png"width="10%;" style="float: right;">
                </div>
            </div>
        </div>
        -->
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import UserClass from "../http/UserClass";

    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public is_push:boolean = false
        public is_badge:boolean = false
        public is_email:boolean = false

        public created() :void
        {
            let $UserClass = new UserClass()

            if ($UserClass.user.is_push){
                this.is_push = true
            }
            if ($UserClass.user.is_badge){
                this.is_badge = true
            }
            if ($UserClass.user.is_email){
                this.is_email = true
            }
        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        /**
         * 通知処理
         * @param eventHandle
         */
        public changeNotification(eventHandle:any) : void
        {
            let data:any = {}
            let flag:boolean = eval("this." + eventHandle.target.getAttribute("target"))

            if (flag){
                data[eventHandle.target.getAttribute("target")] = 1
            }else{
                data[eventHandle.target.getAttribute("target")] = 0
            }

            let $UserClass = new UserClass()
            $UserClass.isLoading = false
            $UserClass.update(data, function(result:any){

            })

        }

        /**
         * アカウントへ
         */
        public onAccount() : void
        {
            this.$router.push({ name: 'account'})
        }

        /**
         * セキュリティへ
         */
        public onSecurity() : void
        {
            this.$router.push({ name: 'security'})
        }

        /**
         * 文字の大きさ
         */
        public onFont() : void
        {
            this.$router.push({ name: 'font'})
        }

        /**
         * 言語の変更
         */
        public onLanguage() :void
        {
            this.$router.push({ name: 'language'})
        }



    }


</script>
