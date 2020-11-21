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
     * カテゴリ取得
     */
    public async getCategory(fncEnd:any=null)
    {
        if (fncEnd){
            this.loadAuth("categoryhash/category", {}, fncEnd)
        }else{
            let result: any = await this.loadAuth("categoryhash/category", {}, fncEnd)
            return result
        }
    }

    /**
     * サブカテゴリの取得
     * @param categoryId
     * @param fncEnd
     */
    public getSubCategory(categoryId:number, fncEnd:any) : void
    {
        let result: any = this.loadAuth("categoryhash/category/sub?categoryId=" + categoryId, {}, fncEnd)
    }

    public async getCategoryGroup(fncEnd:any=null)
    {
        if (fncEnd){
            this.loadAuth("categoryhash/category/group   ", {}, fncEnd)
        }else{
            let result: any = await this.loadAuth("categoryhash/category/group   ", {}, fncEnd)
            return result
        }

    }

    /**
     * 人気のカテゴリ取得
     * @param fncEnd
     */
    public getPopularCategory(fncEnd:any) : void
    {
        let result: any = this.loadAuth("categoryhash/category/popular", {}, fncEnd)

    }

    /**
     * ハッシュをランダム取得
     * @param fncEnd
     */
    public getHashRandom(fncEnd:any) : void
    {
        let result: any = this.loadAuth("categoryhash/hash/random", {}, fncEnd)
    }

}
