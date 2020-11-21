<template>
    <div>
        <div class="dialog" ref="dialog" v-show="isShow" @click="onBackGround">
            <div class="dialog-body" id="dialog_body" ref="dialog_body" :style="styleBody" @click="onBody">
                <dl>
                    <dt v-html="titleView">

                    </dt>
                    <dd>
                        <div v-html="messageView">

                        </div>
                        <div class="text-center margin-top-20">

                            <button type="button" class="find-btn" @click="onCancel" v-if="cancelName" style="width:48%;display:inline-block;">{{cancelName}}</button>
                            <button type="button" class="find-btn2" @click="onOk" style="width:48%;display:inline-block;">{{okName}}</button>

                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import DialogMixin from "../../mixin/DialogMixin.vue"
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator"


    @Component({
        props: {
            title : {type:String, required:true},
            message: {type: String, required: true},
        },

    })


    export default class extends Mixins<DialogMixin>(DialogMixin){
        public message:any
        public messageView:string = ""
        public okName:string = "OK"
        public cancelName:string = ""
        public fncOk:any = null
        public title:any
        public titleView:string = ""

        public mounted()
        {
            this.changeLanguage()
        }

        public changeLanguage()
        {

            if (window.languages[this.message]){
                this.messageView = window.languages[this.message]
                this.titleView = window.languages[this.title]
            }else{
                this.messageView = this.message
                this.titleView = this.title
            }
        }

        public setMessage(message:string)
        {
            this.messageView = message
        }

        public onOk(eventHandle:any)
        {
            eventHandle.stopPropagation()



            if (this.fncOk){
                this.fncOk()
            }
            this.close()
        }

        public onCancel(eventHandle:any)
        {
            eventHandle.stopPropagation()
            this.close()
        }
    }

</script>
