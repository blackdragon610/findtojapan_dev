<template>
    <div>
        <Dialog :title="'エラー'" :message="''" ref="dialog" />

        <div class="row">
            <div class="mainfont titleline col-100">
                <div class="col-20">
                    <div class="margin-top-5 margin-left-12"@click="onCommonBack">
                       <img src="images/back.png"width="24%;" style="margin-top:1px;">
                    </div>
                </div>
                <div class="col-60  text-center margin-top-2">
                    <span v-language="'Search by schedule'">日程からさがす</span>
                </div>
           <div class="col-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="mainfont titleline col-100 margin-top-10">
                <div class="margin-left-14 margin-top-5">
                    <span v-language="'Departure'">出発</span>
                </div>
            </div>
            <div class="col-100 margin-top-12 mainfont">
                <div class="container">
                    <div class="text-center">
                        <form method="get"  class="purpose_container">
                            <img src="images/calender.svg">


                            <Date
                                ref="date_start"
                                :placeholder="'Input field'"

                            />

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mainfont titleline col-100 margin-top-10">
                <div class="margin-left-14 margin-top-5">
                    <span v-language="'Arrival'">到着</span>
                </div>
            </div>
            <div class="col-100 margin-top-12 mainfont">
                <div class="container">
                    <div class="text-center">
                        <form method="get"  class="purpose_container">
                            <img src="images/calender.svg">
                            <Date
                                ref="date_end"
                                :placeholder="'Input field'"
                                />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-100"style="margin-top: 240px;">
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
    import Date from "./layouts/editors/Date.vue";
    import Dialog from "./layouts/Dialog.vue";
    import FormClass from "../liblary/FormClass";

    @Component({
        components: {
            Date,
            Dialog
        },
    })

    export default class extends Mixins<Base>(Base){
        public isDialogShow:boolean = true

        public created() :void
        {

            this.screen()
        }


        public mounted()
        {

        }

        public onSend()
        {
            let $FormClass = new FormClass()
            let datas:any = $FormClass.get(this.refs())

            //入力確認
            var error:string = ""
            if (!datas["date_start"]){
                error = "出発が指定されていません。<br />"
            }
            if (!datas["date_end"]){
                error+= "到着が指定されていません。"
            }

            if (error){
                this.refs().dialog.setMessage(error)
                this.refs().dialog.show()
            }else{
                this.$router.push({ name: 'result', query: { date_start: datas["date_start"],
                        date_end: datas["date_end"] } })
            }
        }

    }


</script>
