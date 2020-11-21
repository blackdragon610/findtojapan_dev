export default class StorageClass{
    /**
     * ストレージの情報を設定
     * @param key
     * @param value
     */
    public set(key:string, value:string){
        localStorage.setItem(key, value)
    }


    /**
     * ストレージの情報を取得
     * @param key
     * @returns {string}
     */
    public get (key:string):any{
        return localStorage.getItem(key)
    }


    /**
     * ストレージの情報をjsonで保持
     * @param key
     * @returns {string|*}
     */
    public setObject(key:string, value:any){
        localStorage.setItem(key, JSON.stringify(value))
    }

    /**
     * ストレージの情報をjsonで取得
     * @param key
     * @returns {string|*}
     */
    public getObject(key:string){
        let value = localStorage.getItem(key)

        if (!value){
            return ""
        }
        if (value == "undefined"){
            return ""
        }

        return JSON.parse(value)
    }

    /**
     * トークンの設定
     */
    public setToken(token:string){
        this.set("token", token)
    }

    /**
     * トークンの取得
     */
    public getToken():any{
        return this.get("token")
    }

    /**
     * ログイン関連の情報の削除
     */
    public deleteLogin(){
        this.user = ""
        this.setToken("")
        this.set("user", "")
    }


    public user:any = this.getObject("user")

}
