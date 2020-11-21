<template>
    <div>
        <span @click="onEvaluation" :class="{evaluation:true, 'evaluation-on':evaluation1}" value="1" ref="evaluation1">★</span>
        <span @click="onEvaluation" :class="{evaluation:true, 'evaluation-on':evaluation2}" value="2" ref="evaluation2">★</span>
        <span @click="onEvaluation" :class="{evaluation:true, 'evaluation-on':evaluation3}" value="3" ref="evaluation3">★</span>
        <span @click="onEvaluation" :class="{evaluation:true, 'evaluation-on':evaluation4}" value="4" ref="evaluation4">★</span>
        <span @click="onEvaluation" :class="{evaluation:true, 'evaluation-on':evaluation5}" value="5" ref="evaluation5">★</span>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from "vue-class-component"
    import FormMixin from "../../../mixin/FormMixin.vue";

    @Component({
        //　プロパティを記述
        props: {

        }

    })

    export default class extends FormMixin {
        public evaluation1:boolean = false
        public evaluation2:boolean = false
        public evaluation3:boolean = false
        public evaluation4:boolean = false
        public evaluation5:boolean = false

        /**
         * 初期設定
         */
        public created()
        {
        }

        /**
         * 星選択
         **/
        public onEvaluation(eventHandle:any) {
            this.updateValue(parseInt(eventHandle.target.getAttribute("value")))
        }

        /**
         * テキストの値の取得
         * @param event
         */
        public updateValue(evaluation:any)
        {
            for (var i:number=1; i <= evaluation; i++) {
                eval('this.evaluation' + i + ' = true')
            }
            for (var i:number=evaluation + 1; i <= 5; i++) {
                eval('this.evaluation' + i + ' = false')
            }

            this.value = evaluation
        }


    }

</script>
