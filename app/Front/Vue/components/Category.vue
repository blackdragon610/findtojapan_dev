<template>
    <div>
        <Dialog :title="'エラー'" :message="''" ref="dialog" />


        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Search by category'">カテゴリからさがす</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-10">
                <div class="margin-left-14 margin-top-5">
                    <span v-language="'Please select a category'">カテゴリを選んでください</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="categoryId" @change="changeCategory">
                        <option v-for="category in categories" :value="category.id" v-language-net>{{category.category_name}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-8">
                <div class="margin-left-14">
                    <span v-language="'Please select a subcategory'" v-language-net>サブカテゴリを選んでください</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="subCategoryId">
                        <option v-for="category in subCategories" :value="category.id" v-language-net>{{category.sub_name}}</option>
                    </select>
                </div>
            </div>
        </div>
        　　<div class="row">
        <div class="mainfont titleline col-100">
            <div class="margin-left-14">
                <span v-language="'Popular categories'">人気のカテゴリ</span>
            </div>
        </div>
    </div>
        <div class="container">

            <div class="row">
                　　  <div class="col-100 margin-top-20">
                <div class="cleafix">
                    <div class="hushtugpurple flexiblebox margin-right-10" v-for="category in popularCategories" :target="category.id" @click="onPopular" style="width:auto;padding:0px 5px;">
                        {{ category.category_name }}
                    </div>
                </div>

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-100"style="margin-top: 150px;">
                <div style="text-align: center;">
                    <button type="button"class="find-btnpink" @click="onSend" v-language="'SEARCH'">SEARCH</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import Dialog from "./layouts/Dialog.vue";
    import CategoryHashClass from "../http/CategoryHashClass";

    @Component({
        components: {
            Dialog
        }
    })

    export default class extends Mixins<Base>(Base){
        public categories:any = {}
        public categoryId:number = 0
        public subCategories:any = {}
        public subCategoryId:number = 0
        public popularCategories:any = {}

        /**
         *  初期画面対応
         **/
        public async created()
        {
            let self = this

            let $CategoryHashClass = new CategoryHashClass()
            $CategoryHashClass.getCategory(function(result:any){
                self.categories = result.categories

                if (self.categories[0]){
                    self.categoryId = self.categories[0].id
                }
                self.setSubCategory()

                if (self.$route.query.categoryId){
                    self.categoryId = parseInt(String(self.$route.query.categoryId))
                }
            })



            $CategoryHashClass.getPopularCategory(function(result:any){
                self.popularCategories = result.categories
            })

        }

        /**
         *  カテゴリの変更
         **/
        public async changeCategory()
        {
            this.setSubCategory()
        }

        public async setSubCategory()
        {
            let self = this
            let $CategoryHashClass = new CategoryHashClass()

            $CategoryHashClass.getSubCategory(this.categoryId, function(result:any){

                self.subCategories = result.subCategories

                if (self.subCategories[0]){
                    self.subCategoryId = self.subCategories[0].id
                }

            })

        }

        public onPopular(eventHandle:any) : void
        {
            this.categoryId = eventHandle.target.getAttribute("target")

            this.setSubCategory()
        }

        public onSend()
        {
            this.$router.push({name:"result", query:{subCategoryId:String(this.subCategoryId)}})
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
