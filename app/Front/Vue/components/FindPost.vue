<template>
    <div id="post"> 　

        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-40">
                    <div class="margin-left-15 margin-top-7">
                        POST
                    </div>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-100 margin-top-12">
                    <div  class="post_container">
                       <div class="col-33 position-relative">
                            <div class="pink-cover postfont" :class="{'text-white':isType1,'bg-button':isType1}" target="1" @click="onChangeTag">
                                <span v-language="'Went to'">行ったよ</span>
                            </div>
                        </div>
                        <div class="col-33 position-relative">
                            <div class="pink-cover postfont" :class="{'text-white':isType2,'bg-button':isType2}" target="2" @click="onChangeTag">
                                <span v-language="'Will go'">行くよ</span>
                            </div>
                        </div>
                        <div class="col-33 position-relative">
                            <div class="pink-cover postfont" :class="{'text-white':isType3,'bg-button':isType3}" target="3" @click="onChangeTag">
                                <span v-language="'Review'">レビュー</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'When did you go'">いつ行きましたか</span>?
                </div>
                <div class="col-100 margin-top-12 mainfont">
                     <div method="get"  class="post_container">
                            <img src="images/calender.png">
                            <Date
                                ref="date"
                                :styles="'font-size: 14px;  color: #4f5d6b;'"
                            />
                        </div>
                    <Error ref="error_date" />
                </div>
            </div>
            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Where did you go'">どこに行きましたか？</span>
                </div>
                <div class="col-100 margin-top-12 mainfont">
                        <div method="get"  class="post_container">
                            <img src="images/point.png">
                            <Input
                                :type="'text'"
                                ref="point"
                            />
                        </div>
                    <Error ref="error_point" />
                </div>
            </div>

            <div class="row" v-show="type==3">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Do you want to add a star'">星をつけますか</span>?
                </div>
                <div class="col-100 margin-top-12 mainfont">
                    <div class="margin-left-60">
                        <div method="get"  class="post_container">
                            <Evaluation
                                ref="evaluation"
                                />
                         </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'How was it'">どうでしたか</span>?
                </div>
                <div class="col-100 margin-top-12 mainfont">
                        <div method="get"  pa class="whatpost_container">
                            <Textarea
                                ref="body"
                            />
                        </div>
                    <Error ref="error_body" />
                </div>
            </div>

            <div class="postfont titleline margin-top-10">
                <span v-language="'Photo'">写真を追加</span>
            </div>

            <div class="margin-top-12 mainfont">
                   <div style="display:inline-block;width:23%;margin-right:2%;margin-top:10px;" v-for="index in countPlusImage">
                                <FileDialog
                                    ref="images"
                                    :dir="'posts'"
                                />
                    </div>
            </div>

            <div class="row" style="overflow: visible;">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Do you want to add a hashtag'">ハッシュタグを追加</span>
                </div>
                <div class="col-85 margin-top-12 mainfont" style="overflow: visible;">
                        <div method="get"  class="post_container margin-top-10" v-for="index in countPlusHash" style="overflow: visible;">
                            <img src="images/posthushtug.png"style="width: 28px; margin-top:-2px!important;left:4px;">

                            <Input
                                :type="'text'"
                                ref="hashes"
                                :isSuggestion="true"
                                :suggestionApi="'categoryhash/hash/search'"
                                :suggestionValue="'hash_name'"
                            />
                        </div>
                  </div>
             <div class="col-15 margin-top-24">
                    <img src="images/plus.png" style="float: right; width: 60%;" @click="onPlusHash">
                </div>

            </div>




            <div class="row">
                <div class="postfont titleline col-100 margin-top-10">
                    <span v-language="'Do you want to add a category'">カテゴリを追加</span>
                </div>
                <div class="col-85 margin-top-9 mainfont">
                        <div method="get" class="position-relative"  v-for="index in countPlusCategory"style="margin-top:-4px;">
                              <img src="images/posthushtug.png" style="width: 28px; margin:auto; left:4px; position: absolute!important;z-index: 2;">
                              <Select :datas="categories" ref="categories" :styles="'width:90%;'"></Select>
                       </div>
                </div>
           <div class="col-15 margin-top-23">
                    <img src="images/plus.png" style="float: right; width: 60%;" @click="onPlusCategory">
                </div>
            </div>


            <div class="margin-top-20 margin-bottom-40 text-center">
                <button class="find-btnpink" @click="onSend" v-language="'POST'">POST</button>
            </div>

        </div>
    </div>


</template>

<style>
    .text-white{
        color : #ffffff !important;
    }
</style>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import Input from "./layouts/editors/Input.vue";
    import Evaluation from "./layouts/editors/Evaluation.vue";
    import Date from "./layouts/editors/Date.vue";
    import Error from "./layouts/editors/Error.vue";
    import PostValidate from "../validate/PostValidate";
    import Textarea from "./layouts/editors/Textarea.vue";
    import PostClass from "../http/PostClass";
    import FileDialog from "./layouts/editors/FileDialog.vue";
    import FormClass from "../liblary/FormClass";
    import Select from "./layouts/editors/Select.vue";
    import CategoryHashClass from "../http/CategoryHashClass";

    @Component({
        components: {
            Input,
            Textarea,
            Date,
            Evaluation,
            FileDialog,
            Error,
            Select,
        },
    })

    export default class extends Mixins<Base>(Base){
        public form:any = {}
        public evaluation:number = 0
        public isType1:boolean = true
        public isType2:boolean = false
        public isType3:boolean = false
        public type:number = 1

        public countPlusHash:number = 1
        public countPlusCategory:number = 1
        public countPlusImage:number = 1
        public categories:any = {}

        public async created()
        {

            let $CategoryHashClass = new CategoryHashClass()
            $CategoryHashClass.isLoading = false
            let result = await $CategoryHashClass.getCategoryGroup()

            this.categories = {}
            for (let key in result.categories){
                this.categories[result.categories[key].id] = result.categories[key]
            }


        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
            this.parent().setFooter(3)

            this.$on("image_finished", this.onPlusImage)
        }

        public onPlusHash() : void
        {
            this.countPlusHash++
        }

        public onPlusCategory() : void
        {
            this.countPlusCategory++
        }
        public onPlusImage() : void
        {
            this.countPlusImage++
        }

        /**
         * データ送信
         */
        public async onSend()
        {
            var $FormClass = new FormClass()
            let datas:any = $FormClass.get(this.refs())
            datas.type = this.type

            console.log(datas)

            let $PostValidate = new PostValidate()
            if ($PostValidate.getError(this, datas)){
                let $Post = new PostClass()

                await $Post.save(datas)

                this.$router.push({name:"find"})
            }
        }

        public onChangeTag(eventHandle:any)
        {
            this.isType1 = false
            this.isType2 = false
            this.isType3 = false

            this.type = parseInt(eventHandle.currentTarget.getAttribute("target"))

            eval("this.isType" + this.type + " = true")
        }
    }


</script>
