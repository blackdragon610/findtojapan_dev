<template>
    <div>
        <Header v-show="showHeader" ref="header" />

        <div id="loader-parent">
            <div class="loader">Loading...</div>
        </div>

        <div id="preview" class="preview">
            <div class="body">
                <div class="preview-image">
                    <img src="" />
                </div>

                <div class="text-center padding-bottom-20 margin-top-20" id="preview-">
                    <button class="btn btn-lg btn-black" id="preview-close">閉じる</button>
                </div>
            </div>
        </div>

        <Footer v-show="showFooter" ref="footer"/>


        <div id="contents" v-bind:style="contents">
            <section id="contents-body">
                <router-view></router-view>
            </section>
        </div>

    </div>
</template>



<script lang="ts">
    import Vue from 'vue'
    import Header from "./components/layouts/Header.vue"
    import Footer from "./components/layouts/Footer.vue"
    import router from "./router";
    import Component from "vue-class-component";
    import ScreenClass from "./liblary/ScreenClass.ts"
    import RectClass from "./liblary/RectClass";
    import StorageClass from "./liblary/StorageClass";
    import ResizeObserver from "resize-observer-polyfill";

    @Component({
        components : {
            Header,
            Footer,
        },

        data: () => ({
            showHeader : true,
            showFooter : true,
        }),
    })

    export default class App extends Vue{
        public StorageClass:StorageClass = new StorageClass()

        /**
         * 初期設定
         */
        public created() :void {
            router.push({name:"index"})
        }

        public showHeader:boolean = true
        public showFooter:boolean = true
        public contents:any = ""

        /**
         * スクリーンの設定
         */
        public screen(ScreenClass:ScreenClass) :ScreenClass {
            var size:any
            //ヘッダー
            if (ScreenClass.viewTypes.isHeader) {

                this.showHeader = true

                let block:any = document.getElementById("header")
                block.style.display = "block"

                ScreenClass.screenHeader = (this.$refs as any).header.getRect()

            }else{

                this.showHeader = false
            }


            //フッター
            if (ScreenClass.viewTypes.isFooter) {

                let block:any = document.getElementById("footer")
                block.style.display = "block"
                ScreenClass.screenFooter = (this.$refs as any).footer.getRect()

                this.showFooter = true
            }else{
                this.showFooter = false
            }


            //コンテンツ
            ScreenClass.screenContents = new RectClass(0, ScreenClass.screen.height,
                ScreenClass.screen.width,
                ScreenClass.screen.height - (ScreenClass.screenHeader.height + ScreenClass.screenFooter.height)
                )

            this.contents = {
                top:ScreenClass.screenHeader.height + "px",
                height:ScreenClass.screenContents .height + "px"
            }
            return ScreenClass
        }

        /**
         * フッターのメニューの色
         */
        public setFooter(type:number)
        {
            let footer:any = (this.$refs as any).footer
            footer.menuType = type
        }

    }

</script>
