import ValidateClass from "../liblary/ValidateClass";

export default class extends ValidateClass{
    public validates:any = {
        user_name:{
            required:{

            },
            stringMax:{
                options:{length:255},
            }
        },
        email:{
            required:{
            },
            email:{
            },
            stringMax:{
                options:{length:255},
            }
        },
        password:{
            required:{

            },
            password:{
            },
            stringMax:{
                options:{length:20},
            }
        }

    }
}
