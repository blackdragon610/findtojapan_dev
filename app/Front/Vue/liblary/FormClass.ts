export default class{
    public results:any = {}

    /**
     * refsからフォームデータの取得
     * @param refs
     */
    public get(refs:any)
    {

        for (let key in refs){
            if (Array.isArray(refs[key])){

                this.results[key] = {}

                for (let keyArray in refs[key]){
                    if (this.getValue(refs[key][keyArray])){
                        this.results[key][keyArray] = this.value
                    }
                }
            }else{
                if (refs[key].isForm){
                    if (this.getValue(refs[key])){
                        this.results[key] = this.value
                    }
                }
            }
        }

        console.log(this.results)

        return this.results
    }

    public value:any

    public getValue(ref:any) : boolean
    {
        if (ref.formType == "image"){
            if (ref.value){
                this.value = ref.value
            }else{
                this.value = ""
                return false
            }
        }else{
            this.value = ref.value
        }

        return true
    }

    /**
     * データからrefsの設定
     * @param refs
     */
    public set(datas:any, refs:any)
    {

        for (let key in refs) {
            if (Array.isArray(refs[key])) {

                /*
                results[key] = {}

                for (let keyArray in refs[key]){
                    results[key][keyArray] = refs[key][keyArray].value
                }*/
            } else {
                if (refs[key]){
                    if (refs[key].isForm) {
                        if (refs[key].formType == "image"){
                            refs[key].src = datas[key]
                        }else{
                            refs[key].value = datas[key]
                        }
                    }
                }
            }
        }
    }


}

