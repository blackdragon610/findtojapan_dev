<template>
    <div>
        <input type="file" accept="image/jpeg,image/png" v-show="false" ref="input_file" @change="changeFile" />
        <img @click="onView" v-image="this.src" :dir="dir" no="images/image_plus.png" size="Thum" ref="image" width="50" />

        <div class="file-dialog" v-show="isDialog" @click="onBackground">
            <div class="file-dialog-contents">
                <ul>
                    <li class='dialog-file' @click="onFile">ファイルで選択する</li>
                    <li class='dialog-camera border-top-gray' @click="onCamera">カメラを起動</li>
                </ul>
            </div>
        </div>

        <slot></slot>
    </div>
</template>

<script lang="ts">
    import ToolClass from "../../../liblary/ToolClass"
    import Vue from 'vue'
    import Component from "vue-class-component"
    import FormMixin from "../../../mixin/FormMixin.vue";

    @Component({
        //　プロパティを記述
        props: {
            classs: {type: String, required: false},
            styles: {type: String, required: false},
            placeholder: {type: String, required: false},
            dir: {type: String, required: false},
        }

    })

    export default class extends FormMixin {
        public isDialog:boolean = false
        public dir:any
        public src:string = ""

        public created()
        {
            this.formType = "image"
        }

        public onView()
        {
            let $ToolClass:ToolClass = new ToolClass()

            if ($ToolClass.isAndroid()){
                //Androidの場合はオリジナルの吹き出しを使う
                this.isDialog = true
            }else {
                this.onFile()
            }
        }

        /**
         * ファイルの変更
         */
        public changeFile(eventHandle:any)
        {


            var file = eventHandle.target.files[0];
            var reader:any = new FileReader();
            let self = this
            reader.onload = function() {
                self.setImage(window.btoa(reader.result))
                self.viewImage()
            }

            this.isDialog = false

            reader.readAsBinaryString(file);
        }

        /**
         * ファイルを選択
         */
        public onFile() : void
        {

            let elemFile:any = (this.$refs as any).input_file
            elemFile.click()
        }

        /**
         * ファイルの情報の取得
         */
        public getFile(isReSize:boolean=false, fncEnd:any={})
        {
            if (isReSize){
                return this.makeSmall(this.value, fncEnd)
            }else{
                return this.value
            }
        }

        /**
         * 画像のリサイズ
         * @param DataURL
         */
        public makeSmall(data:any, fncEnd:any)
        {
            // 画像データの縦横サイズを取得する
            var image:any = document.createElement("img");
            image.src = "data:image/jpeg;base64," + data;


            $(image).on("load", function(eventHandle:any){
                var width:number = eventHandle.currentTarget.naturalWidth;
                var height:number = eventHandle.currentTarget.naturalHeight;

                // 縮小する。今回は縦横それぞれ1/2
                var canvas:any = document.createElement("canvas");

                var widthAffter:number = 0
                var heightAffter:number = 0

                if (width > height){
                    //横幅の方が大きい場合
                    if (width > 600){
                        widthAffter = 600
                        heightAffter = (600 / width) * height
                    }else{
                        widthAffter = width
                        heightAffter = height
                    }
                }else{
                    //縦幅の方が大きい場合
                    if (height > 400){
                        heightAffter = 400
                        widthAffter = (400 / height) * width
                    }else{
                        widthAffter = width
                        heightAffter = height
                    }

                }

                canvas.width = widthAffter
                canvas.height = heightAffter
                canvas.getContext("2d").drawImage(image, 0, 0, widthAffter, heightAffter);

                // Base64からバイナリへ変換
                var base64:any = canvas.toDataURL('image/jpeg');
                var bin = atob(base64.replace(/^.*,/, ''));
                var buffer = new Uint8Array(bin.length);
                for (var i = 0; i < bin.length; i++) {
                    buffer[i] = bin.charCodeAt(i);
                }

                fncEnd(window.btoa(bin))
            })

        }


        /**
         * 指定した画像を差し替える
         */
        public viewImage(targetId:string="") : void{
            // @ts-ignore
            (this.$refs as any).image.setAttribute("src", "data:image/jpeg;base64," + this.value)

            this.$parent.$emit("image_finished")
        }

        /**
         * カメラ起動
         */
        public onCamera(){
            // @ts-ignore
            navigator.camera.getPicture(this.cameraSuccess.bind(this), this.cameraError.bind(this), { quality: 20, destinationType: Camera.DestinationType.DATA_URL})
        }

        /**
         * 写真撮影が成功した時
         */
        public cameraSuccess(image:any){
            this.value = image;
            this.viewImage()
        }

        public onBackground()
        {
            this.close()
        }
        /**
         * 写真撮影に失敗した時
         * @param message
         */
        public cameraError(message:any){
            alert("Failed!!: " + message);
        }

        /**
         * ダイアログ閉じる
         */
        public close(){
            this.isDialog = false
        }

        public setImage(data:string)
        {
            this.value  = data
        }

    }

</script>
