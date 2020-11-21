<template>
    <div>
        <Dialog message="" title="エラー" ref="dialogError" />

         <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png" width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Search by area'">エリアからさがす</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-10">
                <div class="margin-left-14 margin-top-5">
                    <span v-language="'Area'">エリア</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="areaId" @change="onAreaChanged">
                        <option value="" v-language="'Please select'">選択してください</option>
                        <option v-for="area in areas" :value="area.id" v-language-net>{{area.area_name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" v-show="isPrefecture">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="prefectureId" @change="onPrefectureChanged">
                        <option value="" v-language="'Please select'">選択してください</option>
                        <option v-for="prefecture in prefectures" :value="prefecture.id" v-language-net>{{prefecture.prefecture_name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" v-show="isPrefectureArea" @change="onPrefectureAreaChanged">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="prefectureAreaId">
                        <option value="" v-language="'Please select'">選択してください</option>
                        <option v-for="prefectureArea in prefectureAreas" :value="prefectureArea.id" v-language-net>{{prefectureArea.area_name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row" v-show="isCity">
            <div class="col-100 text-center">
                <div class="cp_ipselect cp_sl01">
                    <select v-model="cityId">
                        <option value="" v-language="'Please select'">選択してください</option>
                        <option v-for="city in cities" :value="city.id" v-language-net>{{city.city_name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-100"style="margin-top: 50px;">
                <div style="text-align: center;">
                    <button type="button"class="find-btnpink" @click="onSend" v-language="'SEARCH'">SEARCH</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator";
    import Base from "./Base.vue";
    import StorageClass from "../liblary/StorageClass";
    import AreaClass from "../http/AreaClass";
    import {Watch} from "vue-property-decorator";
    import Dialog from "./layouts/Dialog.vue";
    import Input from "./layouts/editors/Input.vue";
    import FileDialog from "./layouts/editors/FileDialog.vue";
    import Error from "./layouts/editors/Error.vue";

    @Component({
        components: {
            Dialog,
        },
    })

    export default class extends Mixins<Base>(Base){
        public areaId:string = ""
        public areas:any = {}

        public isPrefecture:boolean = false
        public prefectureId:string = ""
        public prefectures:any = {}

        public isPrefectureArea:boolean = false
        public prefectureAreaId:string = ""
        public prefectureAreas:any = {}

        public isCity:boolean = false
        public cityId:string = ""
        public cities:any = {}

        public async created()
        {
            let $AreaClass = new AreaClass()
            let areas:any = await $AreaClass.getArea()

            this.areas = areas.datas

        }
        /**
         * 表示されたら画面の調整
         */
        public mounted() :void
        {
            this.screen()
        }

        //変更されたら
        public async onAreaChanged(newText: string, oldText: string) {
            let $AreaClass = new AreaClass()
            let prefecture:any = await $AreaClass.getPrefecture(null, this.areaId)

            this.prefectureId = ""
            this.prefectures = prefecture.datas
            this.isPrefecture = true

            this.isPrefectureArea = false
            this.isCity = false

        }

        public async onPrefectureChanged(newText: string, oldText: string) {
            let $AreaClass = new AreaClass()
            let prefectureArea:any = await $AreaClass.getPrefectureArea(null, this.prefectureId)

            this.prefectureAreaId = ""
            this.prefectureAreas = prefectureArea.datas

            this.isPrefectureArea = true
            this.isCity = false
        }

        public async onPrefectureAreaChanged(newText: string, oldText: string) {
            let $AreaClass = new AreaClass()
            let cities:any = await $AreaClass.getCity(null, this.prefectureAreaId)

            this.cityId = ""
            this.cities= cities.datas
            this.isCity = true
        }

        public onSend()
        {
            if (this.cityId) {
                this.$router.push({name: "result", query: {cityId: this.cityId}})
            }else if (this.prefectureAreaId){
                this.$router.push({name:"result", query:{prefectureAreaId:this.prefectureAreaId}})
            }else if (this.prefectureId){
                this.$router.push({name:"result", query:{prefectureId:this.prefectureId}})
            }else if (this.areaId) {
                this.$router.push({name: "result", query: {areaId: this.areaId}})
            }else{
                this.refs().dialogError.setMessage("選択されていません")
                this.refs().dialogError.show()
            }

        }

    }


</script>
