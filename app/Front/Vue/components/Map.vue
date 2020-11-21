<template>
    <div id="toppage"> 　
 <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Search by map'">マップからさがす</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>
        <div ref="block_up">
            <div class="container">

                <div class="row">
                    <div class="col-100 margin-top-12">
                        <form method="get" class="search_container" v-model="keyword" v-on:submit.prevent="onKeyword">
                            <img src="images/search.png">
                            <input type="search" placeholder="Search" style="font-size: 14px; margin-top: 1.7px;" x-webkit-speech v-model="keyword">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="margin-top-10">
            <div class="" :style="{height:heightMap}">
                <GoogleMap
                    :zoom=14
                    :center="{lat:0, lng:0}"
                    ref="map"
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
        public heightMap:any = "0px"

        public created() :void
        {

            let self = this


        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()


            this.refs().block_up.setBoun
            this.heightMap = (this.ScreenClass.screenContents.height -  this.refs().block_up.clientHeight) + "px"
        }


        /**
         * キーワード検索
         */
        public onKeyword() : void
        {
            this.refs().map.keyword = this.keyword
        }
    }


</script>
