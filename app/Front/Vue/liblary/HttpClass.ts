import axios from "axios";
import ScreenClass from "./ScreenClass";
import StorageClass from "./StorageClass";

class HttpClass{
    public isLoading:boolean = true
    public page:number = 0
    public axios:any

    /**
     * 非同期処理(会員用)
     * @param url
     * @param params
     * @param fncEnd
     */
    public async loadAuth(url:string, params:any={}, fncEnd:any=null)
    {
        let $StorageClass = new StorageClass()
        params.token = $StorageClass.getToken()


        if (fncEnd){
            this.load(url, params, fncEnd)
        }else{
            return await this.load(url, params, fncEnd)
        }
    }
    /**
     * 非同期処理
     * @param url
     * @param params
     * @param fncEnd
     */
    public async load(url:string, params={}, fncEnd:any=null)
    {
        let $ScreenClass = new ScreenClass()

        if (this.isLoading){
            $ScreenClass.loading(true)
        }

        if (fncEnd){
            //非同期
            await this.http(url, params, fncEnd)
                .then(response => {
                    if (response.status !== 200) {
                        alert('api call error')
                        return
                    }

                    $ScreenClass.loading(false)

                    fncEnd(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                    $ScreenClass.loading(false)
                })
        }else{
            //同期
            let res:any = await this.http(url, params, fncEnd)
            $ScreenClass.loading(false)

            return res.data
        }

    }

    public cancel:any

    /**
     * http通信
     * @param url
     * @param params
     * @param fncEnd
     */
    public async http(url:string, params:any={}, fncEnd = function(data:any){})
    {
        params.page = this.page
        let self = this

        try{
            let res:any = axios
                .post(window.env.APP_URL + "/api/" + url, params,{cancelToken: new axios.CancelToken(function executor(c:any)
                    {
                        self.cancel = c;
                    })})

            return res
        } catch (e) {
            console.log(e)
        }
    }

    /**
     * http通信(外部)
     * @param url
     * @param params
     * @param fncEnd
     */
    public async httpOut(url:string, params:any={}, fncEnd = function(data:any){})
    {
        params.page = this.page


        try{
            let res:any = axios
                .get(url, params)
                .then(response => {
                    fncEnd(response.data)
                })
            return res
        } catch (e) {
            console.log(e)
        }
    }

}

export {HttpClass}
