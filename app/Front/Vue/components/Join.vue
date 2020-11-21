<template>
    <div id="join">
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-7">
                <div class="col-10">
                    <div class="margin-left-15">
                        JOIN
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="clearfix">

                <div class="joinbox" v-for="event in events" @click="onEvent" :target="event.id">

                   <h1 style="pointer-events: none;"> {{ event.event_name }}</h1>
                    <dl style="pointer-events: none;">
                        <dt class="fontpoint">
                            <span format="Y年m月d日" v-date="event.date_limit"></span>
                        </dt>
                        <dd class="fontpoint2">
                            <span format="H時i分" v-date="event.date_limit"></span>まで
                        </dd>
                        <dd class="planningfont">
                            {{ event.company.user_name }}
                        </dd>
                    </dl>
                 <div class="balloon-top" v-show="event.isJoin">
                        <h1>参加中</h1>
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
    import StorageClass from "../liblary/StorageClass";
    import EventClass from "../http/EventClass";

    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public events:any = []

        public created() :void
        {

            let self = this
            //情報取得
            let $EventClass = new EventClass()
            $EventClass.getList(function(result:any){
                self.events = result.data
            })
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
            this.parent().setFooter(4)
        }

        public onEvent(eventHandle:any) : void
        {
            this.$router.push({name:"join_content", query:{target:eventHandle.currentTarget.getAttribute("target")}})
        }
    }


</script>
