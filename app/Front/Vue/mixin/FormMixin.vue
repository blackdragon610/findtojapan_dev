<script lang="ts">
    import Vue from "vue"
    import { Mixin } from "vue-mixin-decorator"
    import Component from "vue-class-component";
    import ResizeObserver from 'resize-observer-polyfill'

    @Component({
    })

    @Mixin
    export default class extends Vue {
        public isForm:boolean = true
        public formType:string = "normal"
        public value:string = ""

    }
</script>
