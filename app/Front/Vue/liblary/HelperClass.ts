import Vue from "vue";
import ToolClass from "./ToolClass";
import LanguageClass from "../http/LanguageClass";

/**
 * 言語変換
 */
Vue.directive("language",{
    bind(eventHandle:any, binding:any,vnode:any) {
        let $LangueageClass = new LanguageClass()
        $LangueageClass.change(eventHandle, binding)
    },

    update(eventHandle:any, binding:any,vnode:any) {
        let $LangueageClass = new LanguageClass()
        $LangueageClass.change(eventHandle, binding)
    },
})

Vue.directive("language-net",{
    bind(eventHandle:any, binding:any,vnode:any) {
        let $LangueageClass = new LanguageClass()
        $LangueageClass.changeNet(eventHandle)
    },

    update(eventHandle:any, binding:any,vnode:any) {
        let $LangueageClass = new LanguageClass()
        $LangueageClass.changeNet(eventHandle)
    },
})



/**
 * 日付変換
 */
Vue.directive("date",{

    bind(eventHandle:any, binding:any,vnode:any) {
        let $ToolClass = new ToolClass()

        eventHandle.innerText = $ToolClass.date(eventHandle.getAttribute("format"), binding.value)

    },
    inserted() {

    },
    update(eventHandle:any, binding:any,vnode:any) {

    },
    componentUpdated(eventHandle:any, binding:any,vnode:any) {

    },
    unbind(){

    }
});

/**
 * 何日、何時間前かの取得
 */
Vue.directive("date-front",{

    bind(eventHandle:any, binding:any,vnode:any) {
        let $ToolClass = new ToolClass()

        let timeNow:number = parseInt($ToolClass.date("T")) / 1000
        let time:number = timeNow - parseInt(String($ToolClass.date("T", binding.value))) / 1000

        var result:string = ""
        if (time > 60 * 60 * 24){
            result = String(parseInt(String(time / (60 * 60 * 24))))
            result+= '日'
        }else if(time > 60 * 60){
            result = String(parseInt(String(time / (60 * 60))))
            result+= '時間'
        }else if(time > 60){
            result = String(parseInt(String((time / 60))))
            result+= '分'
        }else{
            result = String(parseInt(String(time)))
            result+= '秒'
        }

        eventHandle.innerText = result
    },
    inserted() {

    },
    update(eventHandle:any, binding:any,vnode:any) {

    },
    componentUpdated(eventHandle:any, binding:any,vnode:any) {

    },
    unbind(){

    }
});

/**
 * 画像出力
 */
Vue.directive("image",{

    bind(eventHandle:any, binding:any,vnode:any) {
        let $ToolClass = new ToolClass()
        let result = $ToolClass.getImage(eventHandle.getAttribute("dir"), binding.value, eventHandle.getAttribute("size"), eventHandle.getAttribute("no"))

        eventHandle.setAttribute("src", result)
        $ToolClass.setCircle(eventHandle)
    },
    inserted() {

    },
    update(eventHandle:any, binding:any,vnode:any) {

    },
    componentUpdated(eventHandle:any, binding:any,vnode:any) {
        let $ToolClass = new ToolClass()
        let result = $ToolClass.getImage(eventHandle.getAttribute("dir"), binding.value, eventHandle.getAttribute("size"), eventHandle.getAttribute("no"))

        eventHandle.setAttribute("src", result)
        $ToolClass.setCircle(eventHandle)
    },
    unbind(){

    }
});
