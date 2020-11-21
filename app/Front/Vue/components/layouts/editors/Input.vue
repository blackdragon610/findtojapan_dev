<template>
    <div style="overflow: visible;">
        <input :type="type" v-model="value" :placeholder="placeholder" :class="classs" :style="styles" @keyup="keyUp" />

        <ul class="suggestion" ref="suggestion" v-show="isSuggestionView">
            <li v-for="suggestion in suggestions" @click="onSuggestion">{{suggestion[suggestionValue]}}</li>
        </ul>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from "vue-class-component"
    import FormMixin from "../../../mixin/FormMixin.vue";
    import {HttpClass} from "../../../liblary/HttpClass";

    @Component({
        //　プロパティを記述
        props: {
            type: {type: String, required: true},
            classs: {type: String, required: false},
            styles: {type: String, required: false},
            placeholder: {type: String, required: false},
            isSuggestion: {type:Boolean, required: false},
            suggestionApi: {type:String, required: false},
            suggestionValue: {type:String, required: false}
        }

    })

    export default class extends FormMixin {
        public isSuggestion:any
        public isSuggestionView:boolean = false
        public suggestionApi:any
        public suggestionValue:any
        public suggestions:any = {}
        public suggestionAxoses:any = []

        /**
         * 初期設定
         */
        public created()
        {


        }

        /**
         * キーアップ時の処理
         */
        public keyUp()
        {
            this.isSuggestionView = false

            if (this.isSuggestion)
            {
                if (this.value.length > 0){
                    for (let key in this.suggestionAxoses) {
                        this.suggestionAxoses[key].cancel()
                    }


                    let self = this
                    let $HttpClass = new HttpClass()
                    $HttpClass.isLoading = false




                    $HttpClass.loadAuth(this.suggestionApi, {keyword:this.value}, function(result:any){
                        self.isSuggestionView = true

                        self.suggestions = result.datas
                    })

                    this.suggestionAxoses.push($HttpClass)
                }
            }
        }

        public onSuggestion(eventHandle:any)
        {
            this.value = eventHandle.currentTarget.innerText
            this.isSuggestionView = false
        }


    }

</script>
