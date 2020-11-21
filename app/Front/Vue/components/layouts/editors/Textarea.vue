<template>
    <div>
        <textarea wrap="soft" v-model="value" :placeholder="placeholder" :class="classs" :style="styles"></textarea>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import FormMixin from "../../../mixin/FormMixin.vue";

    @Component({
        //　プロパティを記述
        props: {
            classs: {type: String, required: false},
            styles: {type: String, required: false},
            placeholder: {type: String, required: false},
        }

    })

    export default class extends FormMixin {
        /**
         * 初期設定
         */
        public created()
        {

        }



    }

</script>
