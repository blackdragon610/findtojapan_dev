<script lang="ts">
    import Vue from "vue"
    import { Mixin } from "vue-mixin-decorator"
    import Component from "vue-class-component";
    import ResizeObserver from 'resize-observer-polyfill'

    @Component({
        props: {
            title : {type:String, required:true},
            message: {type: String, required: true},
        },
    })

    @Mixin
    export default class extends Vue {
        public message:any
        public styleBody:string = ""
        public isShow:boolean = false
        public observer:any

        public mounted()
        {

            var self = this

            this.observer = new ResizeObserver((entries) => {

            })
            this.observer.observe(this.$refs.dialog)
        }


        public show()
        {
            this.isShow = true
        }

        public close()
        {
            this.isShow = false
        }

        public onBody(eventHandle:any)
        {
            eventHandle.stopPropagation()
        }

        public onBackGround(eventHandle:any)
        {
            eventHandle.stopPropagation()

            this.close()
        }

        public beforeDestroy()
        {
            this.observer.disconnect(this.$refs.dialog)
        }

    }
</script>
