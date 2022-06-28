<?php

namespace mvorobiov\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * @property integer $id
 * @property integer $real_id
 * @property string $user_name
 * @property string $user_phone
 * @property integer $warehouse_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property integer $items_count
 */
class Order extends \yii\db\ActiveRecord
{
    public function behaviors(): array {
        $beforeInsert = ['updated_at'];

        if(!$this->created_at) {
            $beforeInsert[] = 'created_at';
        }

        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => $beforeInsert,
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function rules(): array {
        return [
            [['real_id', 'user_name', 'user_phone', 'warehouse_id', 'created_at', 'status', 'items_count'], 'required'],
            [['real_id', 'warehouse_id', 'status', 'items_count'], 'integer'],
        ];
    }

    public static function tableName(): string {
        return 'orders';
    }
}