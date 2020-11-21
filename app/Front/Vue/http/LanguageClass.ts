import {HttpClass} from "../liblary/HttpClass"
import UserClass from "./UserClass";

/**
 * ページ関連
 */
export default class extends  HttpClass{

    constructor()
    {
        super()
    }


    /**
     * 言語情報の取得
     * @param eventId
     */
    public async get(fncEnd:any= {})
    {
        let $UserClass =  new UserClass()
        var language:string = $UserClass.user.language

        if (!language){
            language = "ja"
        }

        if (fncEnd){
            this.load("language/" + language, {}, function(result:any){
                // @ts-ignore
                window.languages = result.datas
                fncEnd()
            })
        }else{
            let result:any = await this.load("language/" + language, {})

            // @ts-ignore
            window.languages = result.datas

        }

    }

    /**
     * 変更
     * @param eventHandle
     * @param binding
     */
    public change(eventHandle:any, binding:any)
    {
        eventHandle.innerText = window.languages[binding.value]
    }

    public changeNet(eventHandle:any)
    {
        let $HttpClass = new HttpClass()

        let $UserClass = new UserClass()

        if ($UserClass.user.language != "ja"){
            var url:string = "https://www.googleapis.com/language/translate/v2?key=" + window.configs.key.apiKey
            url+="&q=" + eventHandle.innerText + "&source=ja&target=" + $UserClass.user.language

            $HttpClass.httpOut(url, {}, function(result:any){
                eventHandle.innerText = result.data.translations[0].translatedText
            })
        }

    }
}
