import ToolClass from "./ToolClass"
import ValidateMessage from "../message/validate"

export default class ValidationClass
{   public errorMessages:any = {}

    public validates:{ [key: string]: any; } = {}

    /**
     * 空のチェック
     */
    public required(string:string)
    {
        if (!string)
        {
            return false
        }


        return true
    }

    /**
     * 数字のチェック
     */
    public numeric(string:string)
    {
        if (!string) {
            return true
        }


        if (!string.match(/^[0-9]*$/)) {
            return false
        }

        return true

    }

    public email(string:string)
    {
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(string);
    }

    /**
     * 電話番号のチェック
     * @param string
     * @returns {boolean}
     */
    public tel(string:string)
    {
        if (!string) {
            return true
        }


        if (!string.match(/^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/)) {
            return false
        }

        return true
    }

    /**
     * パスワードチェック
     * @param string
     * @returns {boolean}
     */
    public password(string:string)
    {

        let pattern =
            "^("
            + "(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])"	//英小文字、英大文字、数字
            + "|"
            + "(?=.*[a-z])(?=.*[A-Z])(?=.*[!-/:-@\\[-`{-~])"	//英小文字、英大文字、記号
            + "|"
            + "(?=.*[a-z])(?=.*[0-9])(?=.*[!-/:-@\\[-`{-~])"	//英小文字、数字、記号
            + "|"
            + "(?=.*[A-Z])(?=.*[0-9])(?=.*[!-/:-@\\[-`{-~])"	//英大文字、数字、記号
            + ")"
            + "[a-zA-Z0-9!-/:-@\\[-`{-~]{8,}$";	//英大文字、英小文字、数字、記号8文字以上
        let reg = new RegExp(pattern)

        if (!string.match(reg)) {
            return false
        }
        return true
    }



    public stringMax(string:string, option:any)
    {
        let $ToolClass = new ToolClass()

        if (!string) {
            return true
        }

        if ($ToolClass.bytes(String(string)) > option["number"]){
            return false
        }

        return true
    }

    public stringMin(string:string, option:any)
    {
        let $ToolClass = new ToolClass()

        if (!string) {
            return true
        }

        if ($ToolClass.bytes(String(string)) < option["number"]){
            return false
        }

        return true
    }

    /**
     * 設定しているエラーのチェック
     * @param data
     */
    public getError(vue:any, data:any) : boolean{
        var isOk:boolean = true

        //言語の読み込み
        let $ValidateMessage = new ValidateMessage()

        for (var key in this.validates)
        {
            if (vue.refs()["error_" + key]){
                vue.refs()["error_" + key].$emit("clear")
            }

            for (var errorKey in this.validates[key])
            {
                var options = {}
                if ("options" in this.validates[key][errorKey]){
                    options = this.validates[key][errorKey]
                }


                let result = eval("this." + errorKey + "(data[key], options)")
                if (!result) {
                    if (!this.errorMessages[key]){
                        isOk = false

                        if (this.validates[key][errorKey].message){
                            this.errorMessages[key]=this.validates[key][errorKey].message
                        }else{
                            this.errorMessages[key] = $ValidateMessage.getMessage(errorKey)
                        }

                        if (vue.refs()["error_" + key]){
                            vue.refs()["error_" + key].$emit("error", {message:this.errorMessages[key]})
                        }
                    }
                }
            }
        }



        return isOk
    }


}
