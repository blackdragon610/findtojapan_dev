import {HttpClass} from "../liblary/HttpClass"

/**
 * いいね関連
 */
export default class extends  HttpClass{


    constructor()
    {
        super();
    }

    /**
     * ユーザー関連のいいねの保存処理
     * @param email
     * @param password
     */
    public saveUser(userId:number, fncEnd:any)
    {
        this.loadAuth("like/user/" + userId  +"/save", {}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * ユーザー関連のいいねの削除処理
     * @param email
     * @param password
     */
    public saveDestroyUser(userId:number, fncEnd:any)
    {
        this.loadAuth("like/user/" + userId  +"/destroy", {}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * 記事関連のいいねの保存処理
     * @param email
     * @param password
     */
    public savePost(postId:number, fncEnd:any)
    {
        this.loadAuth("like/post/" + postId  +"/save", {}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * 記事関連のいいねの削除処理
     * @param email
     * @param password
     */
    public saveDestroyPost(postId:number, fncEnd:any)
    {
        this.loadAuth("like/post/" + postId  +"/destroy", {}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * 記事関連のリプライの保存処理
     * @param email
     * @param password
     */
    public saveReply(postId:number, comment:string, fncEnd:any)
    {
        this.loadAuth("reply/post/" + postId  +"/save", {comment:comment}, function(result:any){
            fncEnd(result)
        })
    }

    /**
     * 記事関連のいいねの削除処理
     * @param email
     * @param password
     */
    public saveDestroyReply(postId:number, fncEnd:any)
    {
        this.loadAuth("reply/post/" + postId  +"/destroy", {}, function(result:any){
            fncEnd(result)
        })
    }
}
