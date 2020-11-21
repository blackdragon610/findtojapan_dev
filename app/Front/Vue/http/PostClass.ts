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
     * キーワードから検索
     * @param keyword
     */
    public getSearch(searches:any, fncEnd:any={})
    {
        let result:any = this.loadAuth("post/list", searches, fncEnd)

    }

    /**
     * ユーザーの一覧の取得
     * @param userId
     */
    public async getUser(userId:number, fncEnd:any=null)
    {
        if (fncEnd){
            this.loadAuth("post/" + userId + "/user", {}, function(result:any){
                fncEnd(result.data)
            })
        }else{
            let result:any = await this.loadAuth("post/" + userId + "/user")
            return result
        }
    }

    /**
     * マップの情報取得
     */
    public getMap(bounds:any, fncEnd:any)
    {
        this.loadAuth("post/map", bounds, fncEnd)
    }

    /**
     * Nowの取得
     * @param fncEnd
     * @param keyword
     */
    public async getNow(fncEnd:any,keyword:string="")
    {
        this.loadAuth("post/now", {keyword:keyword}, fncEnd)

    }

    /**
     * Post投稿処理
     * @param email
     * @param password
     */
    public async save(data:any={})
    {
        let result:any = await this.loadAuth("post/save", {data:data})

        return result.data
    }


    public async get(postId:number)
    {
        let result:any = await this.loadAuth("post/" + postId + "/get", {})

        return result.data
    }
}
