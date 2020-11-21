export default class{

    public moveMonth(date:string, mode:string="next")
    {
        let dates = date.split("-")
        var year:number = parseInt(dates[0])
        var month:any = parseInt(dates[1])

        if (mode == "next"){
            month++
        }else{
            month--
        }

        if (month > 12){
            year++
            month = "01"
        }
        if (month < 1){
            year--
            month = "12"
        }

        if (month < 10){
            month = "0" + month
        }

        return year + "-" + month
    }

    public date(txt:string, d:any="")
    {

        if (d){

            if (d.length == 7){
                d = d + "-01"
            }
        }

        if (d === "")
        {
            d = new Date()
        }else {
            d = new Date(d.replace(/\-/g, "/"))
        }

        const dgt = ({m, n}: { m: any, n: any }) => ('0000' + m).substr(-n);
        const arr = [
            {k: 'Y', v: d.getFullYear()}
            ,{k: 'wa', v: d.getFullYear() - 2018}
            ,{k: 'YY',   v: dgt({m: d.getFullYear(), n: 2})}
            ,{k: 'm',   v: dgt({m: d.getMonth() + 1, n: 2})}
            ,{k: 'M',    v: d.getMonth() + 1}
            ,{k: 'd',   v: dgt({m: d.getDate(), n: 2})}
            ,{k: 'D',    v: d.getDate()}
            ,{k: 'H',   v: dgt({m: d.getHours(), n: 2})}
            ,{k: 'h',    v: d.getHours()}
            ,{k: 'i',   v: dgt({m: d.getMinutes(), n: 2})}
            ,{k: 'I',    v: d.getMinutes()}
            ,{k: 's',   v: dgt({m: d.getSeconds(), n: 2})}
            ,{k: 'S',    v: d.getSeconds()}
            ,{k: 'w',    v: d.getDay()}
            ,{k: 't',    v: new Date(d.getFullYear(), d.getMonth() + 1, 0).getDate()}
            ,{k: 'T',    v: d.getTime()}
            //       ,{k: 'iii',  v: dgt(d.getMilliseconds(), 3)}
            //       ,{k: 'i',    v: d.getMilliseconds()}
        ];

        arr.forEach(x => {txt = txt.replace(x.k, x.v)});
        return txt;
    }

    public bytes(string:string){
        return encodeURIComponent(string).replace(/%../g,"x").length;
    }

    public nl2br(str:string)
    {
        return str.replace(/\r?\n/g, "<br />")
    }

    public scrollBottom()
    {
        //var element = document.documentElement;
        //var bottom = element.scrollHeight - element.clientHeight + 100;

        var bottom:number = parseInt(String($("#contents-body").height()))

        $("#contents").scrollTop(bottom)
    }

    public changeWeek(data: { [key: string]: any; })
    {
        var weeks: { [key: string]: any; } = {}


        for (var i = 1; i <= 7; i++)
        {
            if (data){
                if (data["week" + i])
                {
                    weeks[i] = data["week" + i]
                }else{
                    weeks[i] = 0
                }
            }else{
                weeks[i] = 0
            }
        }



        return weeks
    }

    public getVariable(variable:any, key:string)
    {
        if (!variable){
            return ""
        }


        if (key in variable)
        {
            return variable[key]
        }
    }

    public movefun( event:any ){
        event.preventDefault();
    }

    /**
     * 使っているモバイルの取得
     */
    public isIphone() :boolean
    {
        return /iP(hone|(o|a)d)/.test(navigator.userAgent)
    }
    public isAndroid() :boolean
    {
        if (navigator.userAgent.match(/Android/i)) {
            return true
        }

        return false
    }

    public isMobile() : boolean
    {
        var isResult:boolean = false

        if (this.isIphone()){
            isResult = true
        }

        if (this.isAndroid()){
            isResult = true
        }


        return isResult
    }

    public getImage(dir:string, image:string, size:string, no:string="")
    {
        if (image){
            return  window.env.APP_URL
                + "/api/image?dir=" + dir
                + "&image=" + image + "&size="
                + size
        }else{
            if (no){
                return no
            }else{
                return  "images/no-image.png"
            }
        }

    }

    public setCircle(eventHandle:any)
    {
        eventHandle.height = eventHandle.width


        eventHandle.onload = function(){
            eventHandle.height = eventHandle.width
        }
    }

    public number_format(num:number, decimals:number)
    {
        //小数点以下の表示桁数
        var _decimals = decimals | 0;

        //指定桁以下を切り捨てた数値
        var _shift = Math.pow(10, _decimals);
        var _floor = Math.floor(num * _shift) / _shift;

        //整数部と小数部に分ける
        var _integerPart = Math.floor(_floor);
        var _decimalPart = (_floor.toString().split('.').length > 1) ? _floor.toString().split('.')[1] : '';

        //整数部にカンマを付与
        var _num = Math.abs(_integerPart).toString().split(/(?=(?:\d{3})+$)/).join();

        //小数部を付与
        if (_decimals > 0) {
            var zeroStr = '';
            for (var i = 0; i < _decimals; i ++) zeroStr += '0';
            _num += '.' + (zeroStr + _decimalPart).slice(-_decimals);
        }

        //負の記号を付与して返却
        return (num < 0) ? ('-' + _num) : _num;
    }

    public out(string:string, length:number, modStr:string="...")
    {
        if(string.length > length){
            return string.substr(0, length) + modStr
        }

        return string

    }

    public sanitaize(str:string) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    public queryUndefined(datas:any) : any
    {
        console.log(datas)

        for (let key in datas){
            if (datas[key] == undefined){
                datas[key] = ""
            }
        }



        return datas
    }

    public changeSnakeToCamel(p:string)
    {
        //_+小文字を大文字にする(例:_a を A)
        return p.replace(/_./g,
            function(s) {
                return s.charAt(1).toUpperCase();
            }
        );
    };

}

