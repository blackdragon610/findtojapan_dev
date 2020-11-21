import Vue from 'vue'
import router from './router'
import App from './App.vue'
import './liblary/HelperClass.ts'
import ToolClass from "./liblary/ToolClass";
import LanguageClass from "./http/LanguageClass";

// window.ts
declare global {
    interface Window {
        env: any
        configs: any
        languages:any
    }
}


// @ts-ignore
window.env = env


// @ts-ignore
window.configs = configs




let $ToolClass = new ToolClass()


if ($ToolClass.isMobile()){

    document.addEventListener("deviceready", onDeviceReady, false)

}else{
    window.env.APP_URL = window.env.APP_URL_LOCAL

    //シミュレータの場合実行
    new Vue({
        el: '#app',
        router,
        components: {App},
        template: '<App />',
    })
}

//実機の場合に実行
function onDeviceReady() {
    new Vue({
        el: '#app',
        router,
        components: {App},
        template: '<App />',
    })
}



