<?php
namespace App\Validation;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    public function __construct($translator, $data, $rules, $messages){
        $this->datas = $data;

        parent::__construct($translator, $data, $rules, $messages);
    }



    public function validateAlphaDash($attribute, $value){
        return (preg_match("/^[@.a-z0-9_-]+$/i", $value));
    }

    public function validateZipcode($attribute, $value, $parameters){
        return preg_match('/^\d{3}-\d{4}$/', $value);
    }

    public function validatePassword($attribute, $value, $parameters){
        if (!$value){
            return true;
        }

        if (preg_match('#\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-/:-@[-`{-~])[!-~]{8,12}+\z#i', $value)){

         if (preg_match('/[A-Z]/', $value)){
				 		return true;
	       }

        }

        return false;
    }
    public function validateNumber($attribute, $value){

	    if (!$value){
		    return true;
	    }

      return (preg_match("/^[0-9]+$/i", $value));
    }

    public function validateStringMax($attribute, $value, $parameters){
			if (strlen($value) <= $parameters[0]){
				return true;
			}

			return false;
    }

    protected function replaceStringMax($message, $attribute, $rule, $parameters)
    {

				if ($parameters[1] == '全角'){
	        $message = str_replace(':max', intval($parameters[0] / 2), $message);
				}else{
	        $message = str_replace(':max', $parameters[0], $message);
				}

        $message = str_replace(':type', $parameters[1], $message);

        return $message;
    }

    public function validateStringMin($attribute, $value, $parameters){
			if (strlen($value) > $parameters[0]){
				return true;
			}

			return false;
    }

    protected function replaceStringMin($message, $attribute, $rule, $parameters)
    {

				if ($parameters[1] == '全角'){
	        $message = str_replace(':min', intval($parameters[0] / 2), $message);
				}else{
	        $message = str_replace(':min', $parameters[0], $message);
				}

        $message = str_replace(':type', $parameters[1], $message);

        return $message;
    }

    public function validateTel($attribute, $value, $parameters)
    {
			return preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/', $value);
    }

    /*
	    *	重複の除外
	    */
   public function validateDuplication($attribute, $value, $parameters){

	   //idの取得
	   $params = \Request::route()->parameters();
		 $id = array_shift($params);


		 if (\DB::table($parameters[0])->select($parameters[1])->where($parameters[1], $value)->where('id', '<>', $id)->first()){
			 return false;
		 }

		 return true;
   }

    protected function validateItems($attribute, $value, $parameters)
    {
        if ($this->datas["input_type"] == 2){
            return true;
        }

        if (empty($value)){
            return false;
        }

        foreach ($value as $item){
            if (empty($item['item_name'])){
                return false;
            }
            if (strlen($item['item_name']) >= 255){
                return false;
            }
            if (empty($item['quantity'])){
                return false;
            }
            if (strlen($item['quantity']) >= 5){
                return false;
            }
            if (!preg_match("/^[0-9]+$/i", $item['quantity'])){
                return false;
            }

            if (empty($item['unit'])){
                return false;
            }
            if (strlen($item['unit']) >= 10){
                return false;
            }

            if (empty($item['price'])){
                return false;
            }
            if (strlen($item['price']) >= 14){
                return false;
            }
            if (!preg_match("/^[0-9]+$/i", $item['price'])){
                return false;
            }

        }

        return true;
    }

    /*
	    *	ファイルのチェック
	    */
    public function validateFileUpload($attribute, $value, $parameters){
	    $this->isErrorEmpty = false;
	    $this->isErrorMime = false;
	    $this->isErrorSize = false;


	    //アップロードの処理
	    if (method_exists($this->datas[$attribute], 'getRealPath')){
		    //未選択の処理
		    if ($parameters[0] == 'true'){
					if (!$this->datas[$attribute]->getRealPath()){
						$this->isErrorEmpty = true;
						return false;
					}
		    }

		    //拡張子の処理
				if ($parameters[1]){
					$mime = $this->datas[$attribute]->getClientMimeType();
					if ($parameters[1] == 'image'){
						if (($mime != 'image/jpeg') && ($mime != 'image/png') && ($mime != 'image/gif')){
							$this->isErrorMime = true;
							return false;
						}
					}
					if ($parameters[1] == 'pdf'){
						if ($mime != 'application/pdf'){
							$this->isErrorMime = true;
							return false;
						}
					}

				}

				if ($parameters[2]){
						$kb = $this->datas[$attribute]->getClientSize() / 1024;
						$mb = $kb / 1024;

						if ($parameters[2] < $mb){
							$this->isErrorSize = true;
							return false;
						}
				}

	    }else{
		    if ($parameters[1]){
			    if ($parameters[0] == 'true'){
				    //空欄を許さな場合はvalue値がある場合はファイルの存在も確認する
				    if (empty($value)){
							$this->isErrorEmpty = true;

					    return false;
				    }else{
					    $diskStatic = $diskStatic = \Storage::disk('static');

					    if (!file_exists($diskStatic->path($value))){


						    $diskApp = $diskStatic = \Storage::disk($this->datas['fileType'][$attribute]);

						    if (!file_exists($diskApp->path($value))){
							    $this->isErrorEmpty = true;
							    return false;
							   }
					    }
				    }
				   }
			   }
	    }

	    return true;
	  }

    protected function replaceFileUpload($message, $attribute, $rule, $parameters)
    {
	    	if (!empty($this->isErrorEmpty)){
		    	$message = str_replace(':message', 'ファイルを選択してください。', $message);
	    	}
	    	if (!empty($this->isErrorMime)){
		    	$message = str_replace(':message', 'ファイルの形式が違います。', $message);
	    	}

	    	if (!empty($this->isErrorSize)){
		    	$message = str_replace(':message', 'ファイルサイズが大き過ぎます。', $message);
	    	}

	    	return $message;
	  }


}
