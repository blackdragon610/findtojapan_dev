<template>
    <div>
         <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    {{page.page_name}}
                </div>
           <div class="col-20"></div>
            </div>
        </div>

        <div v-html="page.body" class="container margin-top-10">

        </div>

    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import PageClass from "../http/PageClass";

    @Component({
        components: {},
    })

    export default class extends Mixins<Base>(Base){
        public page:any = {}

        public async created()
        {
            var pageId:string = String(this.$route.query.target)

            let $Page = new PageClass();
            this.page = await $Page.get(pageId)

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
