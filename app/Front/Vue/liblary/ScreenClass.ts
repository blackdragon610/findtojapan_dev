import RectClass from "./RectClass"

export default class ScreenClass{
    public viewTypes:any = {
        isHeader:true,
        isFooter:true
    }

    public screen:RectClass   //全体
    public screenHeader:RectClass = new RectClass(0,0,0,0)   //ヘッダー
    public screenFooter:RectClass = new RectClass(0,0,0,0)  //フッター
    public screenContents:RectClass = new RectClass(0,0,0,0)    //コンテンツ


    constructor()
    {
        this.screen = new RectClass(0, 0, window.innerWidth, window.innerHeight)
    }

    private loadingNumber:number = 0

    /**
     * ローディング
     * @param isView
     */
    public loading(isView:boolean){
        let elm:any = document.getElementById("loader-parent")

        if (isView){
            elm.style.display = "block"
            this.loadingNumber++
        }else{
            this.loadingNumber--
            if (this.loadingNumber <= 1){
                elm.style.display = "none"
            }else{
                this.loadingNumber--
            }
        }
    }

}
