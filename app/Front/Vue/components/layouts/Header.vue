<template>
    <header id="header" ref="header">

            <div id="header-up" class="row">
                <div id="header-back" class="col-25">
                    <img src="images/humberger.svg" class="text-center"style="width:20%; margin-top:6px;margin-left:13px;" @click="onHamburger">
               </div>

                <div class="col-50">
                    <img src="images/logo.svg"style="margin-top: 12px; width: 90%; margin-left:13px;" @click="onTop"/>
                </div>
                <div id="header-right" class="col-25">
                    <img src="images/setting.svg" v-on:click="onSetting" style="width:20%; margin-top:6px; margin-right:13px;" />

            </div>
        </div>
    </header>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import RectClass from "../../liblary/RectClass"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue";
    import UserClass from "../../http/UserClass";

    @Component
    export default class Header extends Mixins<Base>(Base){

        public getRect() : RectClass
        {
            return this.getRectRef(this.refs().header)
        }

        public async onSetting()
        {
            this.$router.push({name: "setting"})
        }

        public onHamburger()
        {
            this.$router.push({name: "hamburger"})
        }

        public onTop()
        {
            this.$router.push({name: "find"})
        }

    }
</script>
