<template>
    <div id="post"> 　
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                    <div class="col-60  text-center margin-top-2">
                        <span v-language="'Profile'">Profile</span>
                    </div>
                <div class="col-20"></div>
                </div>
            </div>
        


        <Dialog title="Done" message="Update completed" ref="dialog"></Dialog>

        <div class="container">
            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'One word message'">一言メッセージ</span>
                </div>
                <div class="col-100 margin-top-12 mainfont">
                        <form method="get"  class="post_container">
                            <Input
                                ref="message"
                                :type="'text'"
                                :styles="'font-size: 14px; color: gray;'"
                            />
                        </form>
                    </div>
                    <Error ref="error_date" />
            </div>

            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Self-introduction'">自己紹介</span>
                </div>
                <div class="col-100 margin-top-12">
                        <form method="get" class="whatpost_container">
                            <Textarea
                                ref="pr"
                            />
                        </form>
                    </div>
                    <Error ref="error_body" />
                </div>

            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Photo'">写真</span>
                </div>
                <div class="col-100 margin-top-12 mainfont">
                            <FileDialog
                                ref="image"
                                :dir="'users'"
                            />
                    </div>
                    <Error ref="error_date" />
            </div>

            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Favorite category'">好きなカテゴリー</span>
                </div>
                <div class="col-85 margin-top-10 mainfont" v-for="index in countPlus">
                   
                        <form method="get"  class="position-relative">
                            <img src="images/posthushtug.png"style="width: 28px; margin:auto; left:4px; position: absolute!important;z-index: 2;">

                            <Select :datas="categories" ref="categories" :styles="'width:100%;'"></Select>
                        </form>
                </div>
              <div class="col-15 margin-top-29">
                 <img src="images/plus.png" style="float: right; width: 60%;" @click="onPlus">
                </div>
             </div>
          

            <div class="margin-top-20 margin-bottom-40 text-center">
                <button class="find-btnpink" @click="onSend">UPDATE</button>
            </div>

        </div>
    </div>


</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import Input from "./layouts/editors/Input.vue";
    import Error from "./layouts/editors/Error.vue";
    import Textarea from "./layouts/editors/Textarea.vue";
    import FileDialog from "./layouts/editors/FileDialog.vue";
    import Select from "./layouts/editors/Select.vue";
    import CategoryHashClass from "../http/CategoryHashClass";
    import FormClass from "../liblary/FormClass";
    import UserClass from "../http/UserClass";
    import Dialog from "./layouts/Dialog.vue";
    import {Watch} from "vue-property-decorator";

    @Component({
        components: {
            Input,
            Textarea,
            FileDialog,
            Select,
            Dialog,
            Error,
        },
    })

    export default class extends Mixins<Base>(Base){
        public categories:any = {}

        public async created()
        {

            let self = this
            let $CategoryHashClass = new CategoryHashClass()
            let result = await $CategoryHashClass.getCategory()

            self.categories = {}
            for (let key in result.categories){
                self.categories[result.categories[key].id] = result.categories[key].category_name
            }


        }

        @Watch('countPlus', {deep: true})
        changeDatas(val:any, oldVal:any) {

        }

        /**
         * 表示されたら画面の調整とフォームに設定
         */
        public mounted() :void
        {
            this.screen()

            let $UserClass = new UserClass()
            let $FormClass = new FormClass()
            $FormClass.set($UserClass.user, this.refs())

            //カテゴリの追加
            if ($UserClass.user.categories){
                for (let key in $UserClass.user.categories){
                    this.countPlus++
                }

                //カテゴリの設置が終わった処理
                let self = this
                this.$nextTick(() => {
                    for (let key in self.refs().categories){
                        self.refs().categories[key].value = $UserClass.user.categories[key].category_id
                    }
                });

            }
        }

        /**
         *  プラスが押された場合
         */
        public countPlus:number = 0;
        public onPlus()
        {

            this.countPlus++
        }



        /**
         * データ送信
         */
        public async onSend()
        {
            let $FormClass = new FormClass()
            let datas = $FormClass.get(this.refs())


            let $UserClass = new UserClass()
            await $UserClass.update(datas)
            this.refs().dialog.show()
        }
    }


</script>
