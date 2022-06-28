<?php

namespace mvorobiov\models;


/**
 * @property integer $realId
 */
class OrderId extends \yii\base\Model
{
    public int $realId;

    public function rules(): array {
        return [
            ['realId', 'required'],
            ['realId', 'integer']
        ];
    }
}