<template>
    <div>
        <Dialog message="Update completed" title="Done" ref="dialog" />


        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-10">
                    <div class="margin-top-5 margin-left-10"@click="onCommonBack">
                        <img src="images/back.png"width="85%;" style="margin-top:-3px;">
                    </div>
                </div>
                <div class="col-55 margin-top-4" style="float: right;">
                    <span v-language="'Language change'" v-if="reflash">言語の変更</span>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="cp_ipselect2 cp_sl01">
                <select v-model="language">
                    <option v-for="(language, key) in languages" :value="key">{{language}}</option>
                </select>
            </div>
        </div>

        <div class="margin-top-20 text-center">
            <button type="button"class="find-btnpink" @click="onSend" v-language="'Update'">Update</button>
        </div>
    </div>

</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "../Base.vue"
    import UserClass from "../../http/UserClass";
    import LanguageClass from "../../http/LanguageClass";
    import Input from "../layouts/editors/Input.vue";
    import FileDialog from "../layouts/editors/FileDialog.vue";
    import Dialog from "../layouts/Dialog.vue";
    import Error from "../layouts/editors/Error.vue";


    @Component({
        components: {
            Dialog,
        },
    })
    export default class extends Mixins<Base>(Base){
        public languages:any = {}
        public language:string = ""
        public reflash:boolean = true

        public created() :void
        {
            this.languages = JSON.parse(JSON.stringify(window.configs.lang_type))

            let $UserClass = new UserClass()
            this.language = $UserClass.user.language
        }

        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        /**
         *  更新
         **/
        public async onSend(eventHandle:any)
        {
            let self = this
            let $UserClass = new UserClass()
            $UserClass.update({language:this.language}, function(){
                let $LanguageClass = new LanguageClass()
                $LanguageClass.get(function(){
                    self.reflash = false
                    self.reflash = true

                    self.refs().dialog.changeLanguage()
                    self.refs().dialog.show()
                })
            })
        }



    }


</script>
