<template>
    <div id="toppage"> 　
        <!-- タイトル -->
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                   <img src="images/back.png"width="24%;" style="margin-top:1px;">
                </div>
                </div>
                <div class="col-60  text-center margin-top-2">

                    <div v-if="isCategory">
                        <span v-language="'Search by category'">カテゴリからさがす</span>
                    </div>
                    <div v-else-if="isHash">
                        <span v-language="'Search by hash'">ハッシュからさがす</span>
                    </div>
                    <div v-else-if="isDate">
                        <span v-language="'Search by schedule'">日程から探す</span>
                    </div>
                    <div v-else-if="isArea">
                        <span v-language="'Search by area'">エリアから探す</span>
                    </div>
                    <div v-else>
                        <span v-language="'Search by keyword'">キーワードからさがす</span>
                    </div>
                <div class="col-20"></div>
                </div>
            </div>
        </div>


        <div>
            <div class="container">

                <div class="row">
                    <div class="col-100 margin-top-12">

                        <!-- キーワード -->
                        <form method="get" class="search_container" v-show="isKeywordInput" v-on:submit.prevent="onSend">
                            <img src="images/search.png">
                            <input type="search" placeholder="Search" v-model="keyword" style="font-size: 14px;margin-top: 1.7px; color: #a7bdd1">
                        </form>

                        <!-- カテゴリ -->
                        <div v-show="isCategory">
                            <div class="margin-top-10">
                            <div class="hushtugpurple margin-right-10 inline-block" v-for="category in subCategories" :target="category.id">
                                {{ category.sub_name }}
                            </div>
                            </div>
                        </div>
                        <!-- -->

                    </div>
                </div>
            </div>
        </div>
        <!-- -->


        <!-- 日程 -->
        <div v-show="isDate">
            <div class="container">

                <div class="row">
                    <div class="col-100 margin-top-2 margin-bottom-6 text-center">
                        <form method="get"  class="purpose_container" style="padding-top:5px; padding-bottom:5px; font-size:13px!important;">
                            {{dateStart}} - {{dateEnd}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- -->

        <!-- ハッシュ -->
        <div v-show="isHash">
            <div class="container">
                 <div class="hushtug flexiblebox margin-right-5" :target="hashName">
                    #{{ hashName}}
                </div>
            </div>
        </div>
        <!-- -->
        <div class="titleline col-100 margin-top-1"></div>

        <div v-if="lists.length  < 1">
            <p class="text-center padding-top-10 mainfont">
                <span v-language="'There was no result'">結果はありませんでした</span>
            </p>
        </div>
        <div v-else v-for="list in lists" @click="onPost" :target="list.id">
                <div class="titleline col-100 margin-top-1">
                    <div class="row" style="pointer-events: none;">
                        <div class="col-25">
                            <div class="margin-left-13">
                                <img v-image="list.image" dir="posts" size="Thum"  class="profilecover" width="80%" />
                            </div>
                        </div>
                        <div class="col-60 margin-top-6">
                            <div class="mainfontsub">
                                {{ list.body }}
                            </div>
                            <dl>
                                <dt class="littlesub inline-block" v-for="category in list.categories">
                                    {{category.category_name}}
                                </dt>
                                <dd class="pink-btn-big flexiblebox text-center margin-right-8" style="margin-left:-3px; margin-top: 9px;display:inline-block;" v-for="hash in list.hashes">{{hash.hash_name}}</dd>
                            </dl>
                        </div>
                        <div class="col-15 margin-top-5">
                            <div class="margin-left-13">
                                <img src="images/redtrophy.png" width="60%"/>
                            </div>
                            <dl class="profilecircle margin-top-6 margin-left-9">
                                <dt>
                                    <img v-if="list.user" v-image="list.user.image" dir="users" circle="true" size="Thum" @click="onUser" :target="list.user.id" />
                                </dt>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

    </div>


</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import StorageClass from "../liblary/StorageClass";
    import PostClass from "../http/PostClass";
    import CategoryHashClass from "../http/CategoryHashClass";
    import ToolClass from "../liblary/ToolClass";

    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public isKeyword:boolean = false
        public isDate:boolean = false
        public isCategory:boolean = false
        public isHash:boolean = false
        public isKeywordInput:boolean = false
        public isArea:boolean = false

        public keyword:string = ""
        public hashName:string = ""
        public dateStart:string = ""
        public dateEnd:string = ""

        public areaId:string = ""
        public prefectureId:string = ""
        public prefectureAreaId:string = ""
        public cityId:string = ""

        public categoryId:number = 0
        public subCategoryId:number = 0
        public categories:any = {}
        public subCategories:any = {}

        public lists:any = {}

        public created() :void
        {
            this.view()
        }

        public view() : void
        {
            var searches:any = {}

            //クエリの最適化
            let $ToolClass = new ToolClass()

            let query:any = $ToolClass.queryUndefined(this.$route.query)

            //キーワード
            if (query.keyword){
                this.isKeywordInput = true

                if (!this.keyword){
                    this.keyword = String(query.keyword)
                }
            }
            searches.keyword = this.keyword

            //日付
            if (query.date_start){
                this.isDate = true
                searches.dateStart = this.dateStart = String(this.$route.query.date_start)
                searches.dateEnd = this.dateEnd = String(this.$route.query.date_end)
            }

            //エリア
            if (query.areaId){
                this.isKeywordInput = true
                this.isArea = true
                searches.areaId = this.areaId = String(this.$route.query.areaId)
            }

            if (query.prefectureId){
                this.isKeywordInput = true
                this.isArea = true
                searches.prefectureId = this.cityId = String(this.$route.query.prefectureId)
            }


            if (query.prefectureAreaId){
                this.isKeywordInput = true
                this.isArea = true
                searches.prefectureAreaId = this.cityId = String(this.$route.query.prefectureAreaId)
            }

            if (query.cityId){
                this.isKeywordInput = true
                this.isArea = true
                searches.cityId = this.cityId = String(this.$route.query.cityId)
            }

            //ハッシュ
            if (query.hash_name){
                this.isKeywordInput = true
                searches.hashName = this.hashName = query.hash_name
                this.isHash = true
            }

            //カテゴリ
            searches.subCategoryId = this.subCategoryId = parseInt(query.subCategoryId)

            if (query.subCategoryId){
                this.isKeywordInput = true

                //カテゴリ用の処理
                this.isCategory = true


                let self = this
                let $CategoryHashClass = new CategoryHashClass()
                $CategoryHashClass.getSubCategory(this.categoryId, function(result:any){
                    self.subCategories= []

                    for (let key in result.subCategories){
                        if (result.subCategories[key].id == self.subCategoryId){
                            self.subCategories.push(result.subCategories[key])
                        }
                    }
                })

            }

            let $PostClass = new PostClass()
            $PostClass.getSearch(searches, this.loadEnd.bind(this))


        }

        public loadEnd(result:any)
        {
            this.lists = result.datas
        }

        public onSend()
        {
            this.view()
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        /**
         * 記事を選択
         */
        public onPost(eventHandle:any)
        {
            this.$router.push({name:"post_detail", query:{target:eventHandle.currentTarget.getAttribute("target")}})
        }

        /**
         * ユーザーを選択
         */
        public onUser(eventHandle:any)
        {

        }
    }


</script>
