import {HttpClass} from "../liblary/HttpClass"

/**
 * フォロワー関連
 */
export default class extends  HttpClass{


    constructor()
    {
        super();
    }



    /**
     * ユーザー関連の保存処理
     * @param email
     * @param password
     */
    public saveUser(userId:number, fncEnd:any)
    {
        this.loadAuth("follower/user/" + userId  +"/save", {}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * ユーザー関連の削除処理
     * @param email
     * @param password
     */
    public saveDestroyUser(userId:number, fncEnd:any)
    {
        this.loadAuth("follower/user/" + userId  +"/destroy", {}, function(result:any){
            fncEnd(result)
        })
    }

}
