<?php

namespace mvorobiov\models;


/**
 * @property string $url
 */
class Url extends \yii\base\Model
{
    public string $url;

    public function rules(): array {
        return [
            ['url', 'required'],
            ['url', 'url']
        ];
    }
}