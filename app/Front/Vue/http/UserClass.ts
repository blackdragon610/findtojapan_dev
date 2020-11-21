import {HttpClass} from "../liblary/HttpClass"
import StorageClass from "../liblary/StorageClass"
/**
 * ユーザー関連
 */
export default class UserClass extends  HttpClass{
public user:any

    constructor()
    {
        super();

        //最初に保存している保存情報からユーザー情報取得
        let $StorageClass = new StorageClass()
        this.user = $StorageClass.getObject("user")
    }

    /**
     * ユーザーの取得
     * @param userId
     */
    public async get(userId:number)
    {
        let result:any = await this.loadAuth("user/" + userId + "/get")

        return result.data
    }

    /**
     * 認証
     */
    public auth(fncEnd:any={}) :void
    {

        this.user = null
        let $StorageClass = new StorageClass()
        $StorageClass.setObject("user", null)

        let self = this
        let result:any = this.loadAuth("login/auth", {}, function(result:any){
            self.user = result.user
            $StorageClass.setObject("user", self.user)

            fncEnd()
        })

    }

    /**
     * 保存処理
     * @param email
     * @param password
     */
    public async save(data:any)
    {
        let result: any = await this.load("user/save", {data:data})

        return result
    }

    public async emailCheck(email:string)
    {
        let result: any = await this.loadAuth("user/email/check", {email:email})
        var isOk:boolean = true

        if (result.result == "NG"){
            isOk = false
        }

        return isOk
    }

    /**
     * ユーザー情報のアップデート
     * @param data
     * @param fncEnd
     */
    public async update(data:any, fncEnd:any=null)
    {
        for (let key in data){
            this.user[key] = data[key]
        }

        this.updateStorage()

        console.log(data)

        if (fncEnd){
            this.loadAuth("user/change", {data:data}, function(result:any){
                fncEnd(result)
            })
        }else{
            let result: any = await this.loadAuth("user/change", {data:data})

            return result
        }

    }

    /**
     * ユーザーのストレージの保存状態の更新
     * @param data
     */
    public updateStorage()
    {
        let $StorageClass = new StorageClass()
        $StorageClass.setObject("user", this.user)
    }

    /**
     * ログイン処理
     * @param email
     * @param password
     */
    public async login(email:string, password:string)
    {
        let result:any = await this.load("login", {email:email,password:password})

        let $StorageClass = new StorageClass()

        if (result.result == "OK"){
            //トークンの保存
            $StorageClass.setToken(result.token)
        }

        return result.result
    }

    /**
     * ログアウトの処理
     * @param fncEnd
     */
    public async logout(){
        let result:any = await this.loadAuth("login/logout")

        let $StorageClass = new StorageClass()
        $StorageClass.setObject("user", {})
        $StorageClass.setToken("")
    }

    public async count()
    {
        let result:any = await this.loadAuth("user/count")

        return result
    }

}
