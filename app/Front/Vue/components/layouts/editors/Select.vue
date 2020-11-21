<template>
    <div>
        <div class="cp_ipselect2 cp_sl01">
            <select v-if="isGroup" v-model="value" @change="updateValue" :class="classs" :style="styles">
                <optgroup v-for="groups in datas" :label="groups.name">
                    <option v-for="(data, key) in groups.groups" :value="key">{{data}}</option>
                </optgroup>
            </select>

            <select v-else v-model="value" @change="updateValue" :class="classs" :style="styles">
                <option v-for="(data, key) in datas" :value="key">{{data}}</option>
            </select>
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from "vue-class-component"
    import {Watch} from "vue-property-decorator";
    import FormMixin from "../../../mixin/FormMixin.vue";

    @Component({
        //　プロパティを記述
        props: {
            classs: {type: String, required: false},
            styles: {type: String, required: false},
            datas: {type: Object, required: false},
        }

    })

    export default class extends FormMixin {
        public value:string = ""
        public datas:any
        public isGroup:boolean = false

        /**
         * 初期設定
         */
        public created()
        {
            this.setup()
        }

        /**
         *  選択肢が変更された場合
         */
        @Watch('datas', {deep: true})
        changeDatas(val:any, oldVal:any) {
            this.setup()
        }

        public setup()
        {
            for (let key in this.datas){
                //グループかの確認
                if (this.datas[key].groups){
                    this.isGroup = true
                }
            }



            if (!this.value){
                this.value = Object.keys(this.datas)[0]
            }
        }

        /**
         * テキストの値の取得
         * @param event
         */
        public updateValue(eventHandle:any)
        {

            // @ts-ignore
            this.$parent.form[this.name] = eventHandle.target.value
        }

        public getValue()
        {

        }



    }

</script>
