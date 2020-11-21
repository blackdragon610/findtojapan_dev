<script lang="ts">
    import Vue from "vue"
    import { Component, Mixin, Mixins } from "vue-mixin-decorator"
    import ScreenClass from "../liblary/ScreenClass"
    import RectClass from "../liblary/RectClass"
    import UserClass from "../http/UserClass";
    import {KeyboardClass} from "../liblary/KeyboardClass";
    import LikeClass from "../http/LikeClass";

    @Mixin
    export default class Base extends Vue {
        public ScreenClass:ScreenClass = new ScreenClass()
        public isAuth:boolean = true

        public created() :void
        {
            let $KeyboardClass = new KeyboardClass()
            $KeyboardClass.setKeyboardFix()

            /*
            if (this.isAuth){
                let $UserClass = new UserClass()
                if (!$UserClass.user){
                    this.$router.push({name:"login"})
                }
            }*/
        }

        /**
         * 画面調整
         * @param option
         */
        public screen(option:any={}) :void
        {
            //フォントサイズ調整
            this.screenFont()


            for (let key in option){
                this.ScreenClass.viewTypes[key] = option[key]
            }
            (this.$parent as any).screen(this.ScreenClass)
        }

        public screenFont()
        {
            let $UserClass = new UserClass()


            if ($UserClass.user){
                if ($UserClass.user.font == 1){
                    document.body.style.fontSize = "12px"
                }else if ($UserClass.user.font == 3){
                    document.body.style.fontSize = "17px"
                }else{
                    document.body.style.fontSize = "14px"
                }
            }

        }

        /**
         * 要素の四方を取得
         * @param ref
         */
        public getRectRef(ref:any) : RectClass
        {
            let $RectClass = new RectClass(
                ref.getBoundingClientRect().x,ref.getBoundingClientRect().y,
                ref.clientWidth,
                ref.clientHeight
            )



            return $RectClass
        }

        /**
         * 要素の取得
         */
        public refs():any
        {
           return (this.$refs as any)
        }

        /**
         * 親の取得
         */
        public parent():any
        {
            return (this.$parent as any)
        }

        /**
         * 戻る
         */
        public onCommonBack()
        {
            this.$router.go(-1)
        }


        public page:number= 0
        public isRefresh:boolean = false

        /**
         * スクロール関連
         */
        public scrollNavigation()
        {
            (document as any).getElementById("contents").addEventListener('scroll', this.onScroll.bind(this))
            this.loadNavigationNext()
            this.isRefresh = true
        }
        public loadNavigation() {}
        public loadNavigationReflash(){}

        public loadNavigationNext()
        {
            this.loadNavigation()
            this.page++
        }
        /**
         *  上下のスクロールでの反応
         */
        public onScroll()
        {
            if (this.isRefresh){
                const element:any = document.getElementById('contents-body');
                const clientHeight:number = parseInt(String((document as any).getElementById('contents').clientHeight))
                const scrollHeight:number = element.scrollHeight;
                const scrollTop:number= parseInt(String((document as any).getElementById('contents').scrollTop))


                //画面下部に進んだ場合は次に進めさせる
                if (scrollHeight - (clientHeight + scrollTop) <= 0) {
                    this.loadNavigationNext()
                }

                //画面上部に進んだら上の情報を取得
                if (scrollTop < -30){
                    (document as any).getElementById('contents').scrollTo(scrollTop, 0)
                    this.loadNavigationReflash()
                }
            }

        }

        public destroyed() : void
        {
            if (this.isRefresh){
                (document as any).getElementById("contents").removeEventListener('scroll', this.onScroll.bind(this))
                this.isRefresh = false
            }
        }
    }
</script>
