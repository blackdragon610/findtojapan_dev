<template>
    <div id="footer" ref="footer">
        <div id="footer-in">
            <div class="row footer">
                <div class="col-20 text-center" @click="onFind">
                    <div class="padding-all-5 padding-top-14 padding-bottom-14 position-relative">
                        <img src="images/find_on.svg" v-if="menuType==1" />
                        <img src="images/find.svg" v-else />
                        <br /><span class="footer-3 footer-title footer-off text-70 text-base" v-if="menuType==1">FIND</span><span class="footer-3 footer-title footer-off text-70" v-else>FIND</span>
                     </div>
                </div>
                <div class="col-20 text-center" @click="onNow">
                    <div class="padding-all-5 padding-top-14 padding-bottom-14 position-relative">
                        <img src="images/now_on.svg" v-if="menuType==2" />
                        <img src="images/now.svg" v-else />
                        <br /><span class="footer-3 footer-title footer-off text-70 text-base" v-if="menuType==2">NOW</span><span class="footer-3 footer-title footer-off text-70" v-else>NOW</span>
                    </div>
                </div>
                <div class="col-20 text-center" @click="onFindPost">
                    <div class="padding-all-5 padding-top-14 padding-bottom-14 position-relative">
                        <img src="images/post_on.svg" v-if="menuType==3" />
                        <img src="images/post.svg" v-else />
                        <br /><span class="footer-3  text-center footer-title footer-off text-70 text-base" v-if="menuType==3">POST</span><span class="footer-3  text-center footer-title footer-off text-70" v-else>POST</span>
                    </div>
                </div>
                <div class="col-20 text-center" @click="onJoin">
                    <div class="padding-all-5 padding-top-14 padding-bottom-14 position-relative">
                        <img src="images/join_on.svg" class="footer-4" v-if="menuType==4" />
                        <img src="images/join.svg" class="footer-4" v-else /><br /><span class="badge badge-right display-none" id="footer-badge-chat"></span><span class="footer-4 footer-title text-70 text-base" v-if="menuType==4">JOIN</span><span class="footer-4 footer-title text-70" v-else>JOIN</span>
                    </div>
                </div>
                <div class="col-20 text-center" @click="onMypage">
                    <div class="padding-all-5 padding-top-14 padding-bottom-14">

                        <img src="images/mypage_on.svg" class="footer-5" v-if="menuType==5" />
                        <img src="images/mypage.svg" class="footer-5" v-else /><br /><span class="footer-5 footer-title footer-off text-70 text-base" v-if="menuType==5">MY PAGE</span><span class="footer-5 footer-title footer-off text-70" v-else>MY PAGE</span></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue";
    import RectClass from "../../liblary/RectClass";


    @Component
    export default class Footer extends Mixins<Base>(Base){
        public menuType:number = 1

        public created() :void
        {
            /*
            let $UserClass = new UserClass()
            $UserClass.auth(function(result:any){
                if (result.result == "NG"){
                }
            })*/
        }

        public onNow() : void
        {
            this.$router.push({name:"now"})
        }
        public onFind() : void
        {
            this.$router.push({name:"find"})
        }
        public onFindPost() : void
        {
            this.$router.push({name:"findpost"})
        }
        public onJoin() : void
        {
            this.$router.push({name:"join"})
        }

        public onMypage() : void
        {
            this.$router.push({name:"mypage"})
        }

        public getRect() : RectClass
        {
            return this.getRectRef(this.refs().footer)
        }

    }
</script>
