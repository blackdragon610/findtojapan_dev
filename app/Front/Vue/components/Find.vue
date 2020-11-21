<template>
    <div id="toppage"> 　


        <div class="container">

            <div class="row">
                <div class="col-100 margin-top-15">
                    <form method="get" class="search_container" v-model="keyword" v-on:submit.prevent="onKeyword">
                        <img src="images/search.png">
                        <input type="search" placeholder="キーワードから探す" style="font-size: 14px; margin-top: 1px;" v-model="keyword">
                    </form>
                </div>
            </div>
        </div>
        <!-- 目的から探す　!-->


        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="text-center margin-top-15">
                    <span v-language="'Search by purpose'">目的別からさがす</span>
                </div>
            </div>
        </div>
        　
        <div class="container">

            <div class="row">
                　　
                <div class="col-32">
                <div class="destinationbox" @click="onDate">
                    <span v-language="'Date'">日付</span>
                   </div>
                </div>
                <div class="col-offset-2 col-32">
                <div class="destinationbox" @click="onArea">
                    <span v-language="'Area'">エリア</span>
                   </div>
                </div>
              <div class="col-offset-2 col-32">
                <div class="destinationbox" @click="onCategory">
                    <span v-language="'Category'">カテゴリ</span>
                   </div>
                </div>
            </div>
            </div>


        <!-- ハッシュタグから探す　!-->

        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="text-center margin-top-15">
                    <span v-language="'Search by hash'">ハッシュタグからさがす</span>
                </div>
            </div>
        </div>
　　　　

      <div class="container">
            <div class="row">
                <div class="col-100"style="margin-top: 10px;">
                    <div class="cleafix" v-for="hash in hashes">
                        <div class="hushtug margin-right-5":target="hash.hash_name" @click="onHash" v-language-net>
                            #{{ hash.hash_name}}
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <!-- マップから探す　!-->
        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="text-center margin-top-15">
                    <span v-language="'Search by map'">マップからさがす</span>
                </div>
            </div>
        </div>

        <div class="container margin-top-20">
            <div class="" style="height:300px;" @click="onMap">
                <GoogleMap
                    :zoom=14
                    :center="{lat:0, lng:0}"
                >
                </GoogleMap>
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
    import GoogleMapMarker from "./layouts/googles/GoogleMapMarker.vue";
    import PostClass from "../http/PostClass";


    @Component({
        components: {
            GoogleMap,
        }
    })

    export default class extends Mixins<Base>(Base){
        public keyword:string = ""
        public hashes:any = {}
        public markers:any = {}
        public lat:number = 0
        public lng:number = 0
        public isAll:boolean = false

        public created() :void
        {

            let self = this

            let $CategoryHashClass = new CategoryHashClass()
            $CategoryHashClass.getHashRandom(function(result:any){
                self.hashes = result.hashes
            })

        }



        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
            this.parent().setFooter(1)
        }

        /**
         * キーワード検索
         */
        public onKeyword() : void
        {
            this.$router.push({ name: 'result', query: { keyword: this.keyword } })
        }

        /**
         * 日付
         */
        public onDate() : void
        {
            this.$router.push({ name: 'purpose'})
        }

        /**
         * エリア
         */
        public onArea() : void
        {
            this.$router.push({ name: 'area'})
        }

        /**
         * カテゴリ
         */
        public onCategory() : void
        {
            this.$router.push({ name: 'category'})
        }

        /**
         * ハッシュ
         */
        public onHash(eventHandle:any)
        {
            this.$router.push({ name: 'result', query:{hash_name:eventHandle.target.getAttribute("target")}})
        }

        /**
         *  マップ
         **/
        public onMap() : void
        {
            this.$router.push({name:"map"})
        }
    }


</script>
