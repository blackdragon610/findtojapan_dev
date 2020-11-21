<template>
    <div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-5">
                <div class="col-24
                ">
                    <div class="margin-left-15">
                        <span v-language="'Menu'">メニュー</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onHowto">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'About this app'">このアプリについて</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>

        <div class="row" @click="onQuestion">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Frequently Asked Questions'">よくある質問</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>


　　<div class="row">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Contact Us'">お問い合わせ</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>

        <div class="row" @click="onPage" target="kiyaku">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Terms of service'">利用規約</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>
        <div class="row" @click="onPage" target="privacy">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Privacy policy'">プライバシーポリシー</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.9%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>

        <div class="row" @click="onPage" target="license">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'License'">ライセンス</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>
        <div class="row" @click="onPage" target="guidlines">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Posting guidelines'">投稿ガイドライン</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>

        <div class="row" @click="onPage"  target="adv">
            <div class="bigfont titleline col-100 margin-top-5">
                <div class="col-49 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'About advertising'">広告について</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right; margin-right:3px;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="bigfont titleline col-100 margin-top-5" @click="onLogout">
                <div class="col-49 margin-top-2 margin-bottom-2">
                    <div class="margin-left-16">
                        <span v-language="'Logout'">ログアウト</span>
                    </div>
                </div>
                <div class="col-49 margin-top-3 margin-bottom-2">
                    <img src="images/ing.png"width="11.3%;" style="float: right;margin-right:3px;">
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue";
    import UserClass from "../../http/UserClass";


    @Component({

    })

    export default class extends Mixins<Base>(Base){

        public created() :void
        {
            this.screen()
        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {

        }

        /**
         * 各ページに飛ぶ
         * @param eventHandle
         */
        public onPage(eventHandle:any) : void
        {
            this.$router.push({name:"page", query:{target:eventHandle.currentTarget.getAttribute("target")}})
        }

        /**
         * よくある質問
         */
        public onQuestion()
        {
            this.$router.push({name:"question"})
        }

        /**
         * アプリについて
         */
        public onHowto()
        {
            this.$router.push({name:"howto"})
        }

        /**
         * ログアウト
         */
        public onLogout() :void
        {
            let $UserClass = new UserClass()
            $UserClass.logout()
            this.$router.push({name:"login"})
        }
    }


</script>
