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
                     {{title}}
               </div>
           <div class="col-20"></div>
            </div>
        </div>
 <div class="margin-top-25"></div>
        <div v-for="question in questions">
          <div class="row">
          <div class="littlesub titleline col-100">
              <div class="margin-left-25">
                 <div class="col-8">
                 <img src="images/quetion.png"width="86%">
              </div> 
              <div class="col-50 margin-top-3">{{question.question}}</div>
              </div>
            </div>
            <div class="container mainfont">{{question.answer}}</div>
            <br /><br />
         </div>
        </div>
    </div>


</div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import PageClass from "../http/PageClass";


    @Component({

    })

    export default class extends Mixins<Base>(Base){
        public title:string = ""
        public questions:any = {}

        public async created()
        {
            var typeId:string = String(this.$route.query.target)
            //typeId = "1"

            let $PageClass = new PageClass()
            this.questions = await $PageClass.question(typeId)


            console.log(this.questions)

            this.title = window.configs.qa_type[typeId]
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
