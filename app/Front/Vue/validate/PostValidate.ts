import ValidateClass from "../liblary/ValidateClass";

export default class extends ValidateClass{
    public validates:any = {
        date:{
            required:{

            },
            stringMax:{
                options:{length:255},
            }
        },
        point:{
            required:{

            },
            stringMax:{
                options:{length:255},
            }
        },
        body:{
            required:{

            },
            stringMax:{
                options:{length:2000},
            }
        },
    }
}
