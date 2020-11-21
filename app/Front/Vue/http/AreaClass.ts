import {HttpClass} from "../liblary/HttpClass"
import StorageClass from "../liblary/StorageClass"
/**
 * エリア関連
 */
export default class extends  HttpClass{

    constructor()
    {
        super()
    }

    /**
     * エリア
     */
    public async getArea(fncEnd:any=null)
    {
        if (fncEnd){
            this.loadAuth("area/area", {}, fncEnd)
        }else{
            let result: any = await this.loadAuth("area/area", {}, fncEnd)
            return result
        }
    }

    /**
     * 都道府県
     */
    public async getPrefecture(fncEnd:any=null, areaId:string="")
    {
        if (fncEnd){
            this.loadAuth("area/prefecture", {areaId:areaId}, fncEnd)
        }else{
            let result: any = await this.loadAuth("area/prefecture", {areaId:areaId}, fncEnd)
            return result
        }
    }

    /**
     * 都道府県エリア
     */
    public async getPrefectureArea(fncEnd:any=null, prefectureId:string="")
    {
        if (fncEnd){
            this.loadAuth("area/prefecture/area", {prefectureId:prefectureId}, fncEnd)
        }else{
            let result: any = await this.loadAuth("area/prefecture/area", {prefectureId:prefectureId}, fncEnd)
            return result
        }
    }

    /**
     * 市区エリア
     */
    public async getCity(fncEnd:any=null, prefectureAreaId:string="")
    {
        if (fncEnd){
            this.loadAuth("area/city", {prefectureAreaId:prefectureAreaId}, fncEnd)
        }else{
            let result: any = await this.loadAuth("area/city", {prefectureAreaId:prefectureAreaId}, fncEnd)
            return result
        }
    }

}
