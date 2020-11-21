<template>
    <div id="toppage"> 　


        <div class="container">

            <div class="row">
                <div class="col-100 margin-top-12">
                    <form method="get" class="search_container" v-model="keyword" v-on:submit.prevent="onKeyword">
                        <img src="images/search.png">
                        <input type="search" placeholder="キーワードから探す" style="font-size: 14px; margin-top: 1.7px;" v-model="keyword">
                    </form>
                </div>
            </div>
        </div>


        <div class="container margin-top-10">
            <div class="" style="height:200px;" @click="onMap">
                <GoogleMap
                    :zoom=14
                    :center="{lat:0, lng:0}"
                >
                </GoogleMap>
            </div>

        </div>


        <!-- ハッシュタグから探す　!-->
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="text-center margin-top-15">
                    <span v-language="'Popular hashtag'">Popular hashtag</span>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-100 ">
                    <div class="cleafix" v-for="hash in hashes">
                        <div class="hushtug flexiblebox margin-right-5" :target="hash.hash_name" @click="onHash" v-language-net>
                            #{{ hash.hash_name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- カテゴリから探す　!-->
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="text-center margin-top-15">
                    <span v-language="'Popular categories'">Popular categories</span>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-100 ">
                    <div class="cleafix" v-for="category in categories">
                        <div class="hushtug flexiblebox margin-right-5" :target="category.id" style="padding:0px 5px;width:auto;background:#b499c7;" @click="onCategory" v-language-net>
                            {{ category.category_name}}
                        </div>
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
    import CategoryHashClass from "../http/CategoryHashClass";
    import GoogleMap from "./layouts/googles/GoogleMap.vue";


    @Component({
        components: {
            GoogleMap,
        }
    })

    export default class extends Mixins<Base>(Base){
        public keyword:string = ""
        public hashes:any = {}
        public categories:any = {}
        public isAll:boolean = false

        public created() :void
        {

            let self = this

            let $CategoryHashClass = new CategoryHashClass()
            $CategoryHashClass.getHashRandom(function(result:any){
                self.hashes = result.hashes
            })

            $CategoryHashClass.getCategory(function(result:any){
                self.categories = result.categories
            })

        }



        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()


        }

        /**
         *  マップ
         **/
        public onMap() : void
        {
            this.$router.push({name:"map"})
        }

        /**
         * キーワード検索
         */
        public onKeyword() : void
        {
            this.$router.push({ name: 'result', query: { keyword: this.keyword } })
        }



        /**
         * ハッシュ
         */
        public onHash(eventHandle:any)
        {
            this.$router.push({ name: 'result', query:{hash_name:eventHandle.target.getAttribute("target")}})
        }

        public onCategory(eventHandle:any)
        {
            this.$router.push({ name: 'category', query:{categoryId:eventHandle.currentTarget.getAttribute("target")}})
        }
    }


</script>
