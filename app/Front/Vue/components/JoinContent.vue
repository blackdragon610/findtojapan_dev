<template>

    <div>
        <div id="mypage"> 　
          <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png" width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-5">
                 JOIN
                </div>
           <div class="col-20"></div>
            </div>
        </div>
            <div class="row">
                <div class="col-100 profile">
                    <div class="btn-circle-3d">
                        <img v-if="event.company" v-image="event.company.image" dir="companies" size="Thum">
                    </div>
                    <span style="margin-top:12px;"> {{ event.event_name }}</span>
                    <p v-if="event.company">{{ event.company.company_name }}</p>
                    <p style="float: right; margin-top: 8px;" v-if="event.date_limit" v-date="event.date_limit" format="Y年m月d日H時i分まで"></p>
                </div>
            </div>
        </div>


        <div class="mypageline-u">
            <div class="container ibentcontent mainfont margin-top-10" v-html="event.body">

            </div>
        </div>



        <div class="col-100 margin-top-18 text-center mainfont margin-bottom-40">
            <button type="button" class="find-btnblue" @click="onUnJoin" v-if="event.isJoin">参加中</button>
            <button type="button" class="find-btnpink" @click="onJoin" v-else>参加する</button>
        </div>
    </div>



</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import EventClass from "../http/EventClass";

    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public eventId:number = 0
        public event:any = {}

        public async created()
        {
            this.eventId = parseInt(String(this.$route.query.target))

            let $EventClass = new EventClass()
            let data = await $EventClass.get(this.eventId)
            this.event = data.data
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        /**
         * 参加する
         */
        public onJoin() : void
        {
            this.event.isJoin = true
            let $EventClass = new EventClass()
            $EventClass.isLoading = false
            $EventClass.join(this.event.id)
        }

        public onUnJoin() : void
        {
            this.event.isJoin = false

            let $EventClass = new EventClass()
            $EventClass.isLoading = false
            $EventClass.unjoin(this.event.id)
        }
    }


</script>
