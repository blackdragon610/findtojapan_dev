<?php

namespace App\Models;


use Google\Cloud\Translate\TranslateClient;

class Language extends ModelClass
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     *  全て翻訳
     */
    public function adds()
    {
        //翻訳
        $keys = configJson("key");
        $translate = new TranslateClient(['key' => $keys["apiKey"]]);

        $langTypes = configJson("lang_type");
        $langs = configJson("langs");

        foreach ($langTypes as $keyType => $type){
            foreach ($langs as $lang){
                $result = $translate->translate(
                    $lang,
                    ['target' => $keyType]
                );

                $Model = clone $this;
                $Model->add($keyType, $lang, $result["text"]);

            }
        }
    }
    /**
     * 既に存在するかの確認
     * @param  string  $lang
     * @param  string  $from
     * @param  string  $body
     * @return object
     */
    public function add(string $language, string $from, string $body)
    {
        $Model = clone $this;


        $Model = $data = $Model->whereLanguage($language)->whereFrom($from)->first();


        if (!$Model){
            $Model = clone $this;
        }


        if (($Model->is_google) || (!$data)){
            $Model->language = $language;
            $Model->from = $from;
            $Model->body = $body;
            $Model->save();

        }
    }

    /**
     * フォームから登録
     * @param  array  $inputs
     * @return object
     */
    public function saveEntry(array $inputs) : object
    {
        $Model = clone $this;

        if (!empty($inputs["id"])) {
            $Model = $Model->whereId($inputs["id"])->first();
        }

        $Model->setModel($inputs);

        $Model->save();

        return $Model;
    }
}
