export default class{
    public messages:any = {
        required:"入力してください。",
        email:"メールアドレスで入力してください。",
        tel:"電話番号で入力してください。",
        password:"半角英数字で大文字英数を含め記号ありで入力してください。",
    }

    public getMessage(key:string) : string
    {
        return this.messages[key]
    }
}
