<?php

namespace mvorobiov\services\order\entity;

use yii\base\Model;


/**
 * Data-object for displaying order information.
 * We can't rely on ActiveRecord's attributes for representation, even if they're identical
 *
 * @property integer $id
 * @property integer $real_id
 * @property string $user_name
 * @property string $user_phone
 * @property integer $warehouse_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $items_count
 */
class RepresentableOrder extends Model
{
    public int $id;
    public int $real_id;
    public string $user_name;
    public string $user_phone;
    public int $warehouse_id;
    public string $created_at;
    public string $updated_at;
    public int $status;
    public int $items_count;

    public function rules(): array {
        return [
            [['real_id', 'user_name', 'user_phone', 'warehouse_id', 'created_at', 'status', 'items_count'], 'required'],
            [['real_id', 'warehouse_id', 'status', 'items_count'], 'integer'],
        ];
    }
}