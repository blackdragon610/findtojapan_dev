import {HttpClass} from "../liblary/HttpClass"
import StorageClass from "../liblary/StorageClass"
/**
 * ユーザー関連
 */
export default class extends  HttpClass{

    constructor()
    {
        super()
    }

    /**
     * イベント情報のリストの取得
     */
    public async getList(fncEnd:any={})
    {
        let result:any = this.loadAuth("event/list", {}, fncEnd)

        return result
    }

    /**
     * イベント情報の取得
     * @param eventId
     */
    public async get(eventId:number)
    {
        let result:any = await this.loadAuth("event/" + eventId + "/get", {})

        return result
    }

    /**
     * イベント情報に参加
     * @param eventId
     */
    public join(eventId:number)
    {
        let result:any = this.loadAuth("event/" + eventId + "/join", {})

        return result
    }

    /**
     * イベント情報の参加取りやめ
     * @param eventId
     */
    public unjoin(eventId:number)
    {
        let result:any = this.loadAuth("event/" + eventId + "/unjoin", {})

        return result
    }

}
