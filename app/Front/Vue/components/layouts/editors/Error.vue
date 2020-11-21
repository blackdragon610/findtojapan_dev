<template>
    <div class="error" ref="error">
        ※{{errorMessage}}
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from "vue-class-component"

    @Component({

    })

    export default class extends Vue {
        public errorMessage:string = ""

        /**
         * 初期設定
         */
        public mounted() :void
        {
            this.$on("error", this.error)
            this.$on("clear", this.clear)
        }

        /**
         * エラー消去
         */
        public clear() : void
        {
            (this.$refs as any).error.style.display = "none"
        }
        /**
         * エラー処理
         */
        public error(eventHandle:any) : void
        {
            (this.$refs as any).error.style.display = "block"
            this.errorMessage = eventHandle.message


        }

    }

</script>
