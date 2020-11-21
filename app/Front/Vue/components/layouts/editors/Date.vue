<template>
    <div>
        <template>
            <div>
                <input type="text" readonly="readonly" :placeholder="placeholder" :class="classs" :style="styles" ref="date" :value="valueSet" @click="onClick" @input="updateValue" />
            </div>

            <div class="dialog" ref="dialog" v-show="isShow" @click="onBackGround">
                <div class="dialog-body" id="dialog_body" ref="dialog_body" :style="styleBody">
                    <dl>
                        <dd>
                            <div ref="date_table">
                                <div class="row">
                                    <div class="col-20 line-height-percent--150" @click="onBack">
                                        先月
                                    </div>
                                    <div class="col-60 text-center text-weight-800 text-150">
                                        <span>{{month}}</span>月
                                    </div>
                                    <div class="col-20 text-right line-height-percent--150" @click="onNext">
                                        翌月
                                    </div>
                                </div>
                                <table class="table table-border margin-top-20">
                                    <tr><th class='text-red'>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th class='text-sky'>土</th></tr>

                                    <tr v-for="rowDay in rows">
                                        <td v-for="day in rowDay" v-html="day.day" :date="day.date" class="text-center" @click="onEnter"></td>
                                    </tr>
                                </table>
                            </div>

                        </dd>
                    </dl>
                </div>
            </div>
        </template>


    </div>
</template>

<script lang="ts">
    import Component from "vue-class-component"
    import {Mixins} from "vue-mixin-decorator"
    import DialogMixin from "../../../mixin/DialogMixin.vue"
    import ToolClass from "../../../liblary/ToolClass"
    @Component({
        props: {
            classs: {type: String, required: false},
            styles: {type: String, required: false},
            placeholder: {type: String, required: false},
        },

    })

    export default class extends Mixins<DialogMixin>(DialogMixin){
        public value:any
        public isForm:boolean = true
        public formType:string = "normal"
        public valueSet:string = ""

        public rows:any = []
        public month:number = 0
        public ToolClass = new ToolClass()
        public dateNow:string = ""
        public holidays:any = {}

        public created()
        {
            this.valueSet = this.value

            //表示
            this.dateNow = this.ToolClass.date("Y-m-d")
            this.view()
        }

        public onClick()
        {
            this.isShow = true
            this.view()
        }

        public view()
        {

            let month:number = parseInt(this.ToolClass.date("m", this.dateNow))
            this.month = month

            let yearMonth:string = this.ToolClass.date("Y/m", this.dateNow)
            let week:number = parseInt(this.ToolClass.date("w", this.dateNow))
            let lastDay:number = parseInt(this.ToolClass.date("t", this.dateNow))
            var weekNow:number = 0
            var row:number = 0
            var weekStart:boolean = false
            var col:number = 0

            this.rows = []
            this.rows[row] = []

            for (var i = 1; i <= lastDay; i++) {
                this.rows[row][col] = {}
                var day2: any = i
                if (day2 < 10) {
                    day2 = "0" + day2
                }

                let dateNow: string = yearMonth + "/" + day2

                weekNow = parseInt(this.ToolClass.date("w", dateNow))



                //最初の曜日まで進める
                if (!weekStart) {
                    for (col = 0; col < weekNow; col++) {
                        this.rows[row][col] = {}
                        this.rows[row][col].day = "&nbsp;"
                    }
                    weekStart = true
                }
                this.rows[row][col] = {}


                if ((this.holidays[this.ToolClass.date("Y-m-d", dateNow)]) ||
                    (weekNow == 6) || (weekNow == 0)) {
                    this.rows[row][col].isHoliday = true
                } else {
                    this.rows[row][col].isHoliday = false
                }

                this.rows[row][col].day = i
                this.rows[row][col].date = dateNow

                if (weekNow == 6) {
                    row++
                    this.rows[row] = []
                    col = 0
                }else{
                    col++
                }
            }

            for (col = weekNow + 1; col <= 6; col++) {
                this.rows[row][col] = {}
                this.rows[row][col].day = "&nbsp;"
            }

            console.log(this.rows)
        }


        /**
         * 次へ
         */
        public onNext(eventHandle:any)
        {
            eventHandle.stopPropagation()
            this.dateNow = this.ToolClass.moveMonth(this.dateNow)
            this.view()
        }

        /**
         * 前へ
         */
        public onBack(eventHandle:any)
        {
            eventHandle.stopPropagation()
            this.dateNow = this.ToolClass.moveMonth(this.dateNow, "back")
            this.view()
        }


        public onEnter(eventHandle:any)
        {
            eventHandle.stopPropagation()
            this.valueSet = eventHandle.target.getAttribute("date")
            this.updateValue()

            this.isShow = false

        }

        /**
         * テキストの値の取得
         * @param event
         */
        public updateValue()
        {
            this.value = this.valueSet
        }


    }

</script>
