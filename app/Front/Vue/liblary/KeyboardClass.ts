import ToolClass from "./ToolClass";

class KeyboardClass{
    public mode:string = ""
    public paddingBottom:number = 0
    public isInputing:boolean = false
    public isView:boolean = false
    public bodyHeight:number = 0
    public chatPaddingBottom:number = 0
    public beforeScrollTop:number = 0
    public divComposition:any
    public ToolClass = new ToolClass()

    constructor()
    {

        this.bodyHeight = 400 //parseInt(String($("body").height()))



        if (this.ToolClass.isIphone()){
            if (Keyboard){
                if (this.ToolClass.isIphone()) {
                    // @ts-ignore
                    Keyboard.disableScroll(true)
                    Keyboard.hideFormAccessoryBar(false)
                }
            }
        }else{
            return
        }

        let object:any = document.activeElement

        /*let self = this
        //フォーカスのものが入力中かの判定
        $(object).on("compositionstart",function(){
            self.isInputing = true
        })

        $(object).on("compositionend",function(){
            self.isInputing = false;
        })*/


    }

    public setNative()
    {
        if (this.ToolClass.isIphone()) {
            // @ts-ignore
            Keyboard.setResizeMode('native')
            // @ts-ignore
            Keyboard.disableScroll(true)
            Keyboard.hideFormAccessoryBar(false)
        }
    }

    public setBody()
    {
        if (this.ToolClass.isIphone()) {
            // @ts-ignore
            Keyboard.setResizeMode('body')

            //$("#contents").scrollTop(0)

        }
    }

    public allView(id:string, fncEnd:any)
    {
        if (!this.ToolClass.isMobile()){
            //入力終了している場合はすぐに返す
            fncEnd()
            return
        }

        if (!this.isInputing){
            //入力終了している場合はすぐに返す
            fncEnd()
            return
        }

        let $ToolClass = new ToolClass()

        if (!$ToolClass.isIphone()){
            //iphoneではない場合はすぐに返す
            return
        }

        // @ts-ignore
        window.KeyboardPlugin.allView(
            function(result:any) { fncEnd() },
            function(error:any) {  }
        )
    }


    /**
     * fixedのものはフッターは上に被せない様にする
     */
    public setKeyboardFix(mode:string="")
    {

        if (!this.ToolClass.isMobile()){
            return
        }

        this.mode = mode


        window.removeEventListener("keyboardWillShow", this.keyboardFixedFix.bind(this))
        window.addEventListener("keyboardWillShow", this.keyboardFixedFix.bind(this))
        window.removeEventListener("keyboardDidShow", this.keyboardFixedFixDid.bind(this))
        window.addEventListener("keyboardDidShow", this.keyboardFixedFixDid.bind(this))

        window.removeEventListener("keyboardWillHide", this.keyboardFixedFixHide.bind(this))
        window.addEventListener("keyboardWillHide", this.keyboardFixedFixHide.bind(this))



        //let paddingBottom:number = parseInt(String($("#contents-body").css("padding-bottom")))
        //this.paddingBottom = paddingBottom


        if (this.ToolClass.isIphone()) {
            // @ts-ignore
            Keyboard.setResizeMode('body')
        }

        if (this.ToolClass.isIphone()) {
            // @ts-ignore
            Keyboard.disableScroll(true)
            Keyboard.hideFormAccessoryBar(false)
        }

        //const input:any = document.querySelector('input');
        //const textarea:any = document.querySelector('textarea');
        //const select:any = document.querySelector('select');



        /*$("input").on("focus", this.autoScroll.bind(this))
        $("textarea").on("focus", this.autoScroll.bind(this))
        $("select").on("focus", this.autoScroll.bind(this))

        $("input").on("compositionstart", this.compositionStart.bind(this))
        $("textarea").on("compositionstart", this.compositionStart.bind(this))
        $("input").on("compositionend", this.compositionEnd.bind(this))
        $("textarea").on("compositionend", this.compositionEnd.bind(this))*/

    }

    public compositionStart(eventHandle:any)
    {
        this.divComposition = eventHandle.currentTarget
    }
    public compositionEnd()
    {
        this.divComposition = null
    }

    public autoScroll(eventHandle:any)
    {
        alert("E")

        var div:any = eventHandle.currentTarget

        alert(div)

        if (!this.divComposition) {
            /*
            let index:number = $(".keyboard-to").index(div)

            this.beforeScrollTop = parseInt(String($("#contents").scrollTop()))

            let bottom: number = $(".keyboard-from").eq(index).position()!.top!
            $("#contents").animate({"scrollTop": bottom})

             */
        }
    }

    public keyboardFixedFix(eventHandle:any)
    {
        this.isView = true


        //let contentBody:any = document.getElementById("contents-body")
        //contentBody.style.paddingBottom = String(eventHandle.keyboardHeight) + "px"

        let footer:any = document.getElementById("footer")
        footer.style.display= "none"

    }

    public keyboardFixedFixDid(eventHandle:any)
    {


    }

    public keyboardFixedFixHide(eventHandle:any)
    {

        let contentBody:any = document.getElementById("contents-body")
        contentBody.style.paddingBottom = "0px"

        let footer:any = document.getElementById("footer")
        footer.style.display= "block"


    }

    public hide()
    {
        if (!this.ToolClass.isMobile()){
            return
        }

        if (this.isView){
            Keyboard.hide()
            //$("body").height(this.bodyHeight)
            this.isView = false
        }
    }

}

export{KeyboardClass}
