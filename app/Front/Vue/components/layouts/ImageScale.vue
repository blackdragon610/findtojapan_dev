<template>
    <div>
        <img v-image="image" :dir="dir" :size="size" width="100%" @click="onShow">

        <div class="image-scale" v-show="isShow" @click="onClose">
            <div class="close">
                <img src="images/close.svg" @click="onClose" />
            </div>
            <div class="body" @click="cancel">
                <img v-image="image" :dir="dir" size="Big" width="100%">
            </div>
        </div>
    </div>
</template>


<script lang="ts">
    import {Component, Vue} from 'vue-property-decorator'
    import {Prop} from "vue-property-decorator";

    @Component
    export default class extends Vue{
        @Prop() public image!: any
        @Prop() public dir!: any
        @Prop() public size!: any
        public isShow:boolean = false

        public created()
        {

        }

        /**
         * 開く
         **/
        public onShow(eventHandle:any)
        {
            const div:any = document.getElementById("main-body");
            //div.classList.add('blur');

            eventHandle.stopPropagation()
            this.isShow = true
        }

        /**
         *  伝播させない
         */
        public cancel(eventHandle:any)
        {
            eventHandle.stopPropagation()
        }

        /**
         * 閉じる
         * @param eventHandle
         */
        public onClose(eventHandle:any)
        {
            eventHandle.stopPropagation()
            this.isShow = false
        }


    }

</script>
