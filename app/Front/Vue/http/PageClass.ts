import {HttpClass} from "../liblary/HttpClass"

/**
 * ページ関連
 */
export default class extends  HttpClass{

    constructor()
    {
        super()
    }


    /**
     * ページ情報の取得
     * @param eventId
     */
    public async get(type:string)
    {
        let result:any = await this.loadAuth("page/" + type + "/get", {})

        return result.datas
    }

    /**
     * Q&Aの情報の取得
     * @param eventId
     */
    public async question(type:string)
    {
        let result:any = await this.loadAuth("page/" + type + "/question", {})

        return result.datas
    }

}
