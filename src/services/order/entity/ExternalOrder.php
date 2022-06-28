<?php

namespace mvorobiov\services\order\entity;


use yii\base\Model;


/**
 * @property int $id
 * @property int $real_id
 * @property string $user_name
 * @property string $user_phone
 * @property int $warehouse_id
 * @property string $created_at
 * @property int $status
 * @property bool $is_paid
 * @property string|null $promocode
 * @property int $type
 * @property array $items
 */
class ExternalOrder extends Model
{
    public int $id;
    public int $real_id;
    public string $user_name;
    public string $user_phone;
    public int $warehouse_id;
    public string $created_at;
    public int $status;
    public bool $is_paid;
    public ?string $promocode;
    public int $type;
    public array $items;

    public function rules(): array {
        return [
            [['real_id', 'user_name', 'user_phone', 'warehouse_id', 'created_at', 'status'], 'required'],
            [['real_id', 'warehouse_id', 'status'], 'integer'],
            [['created_at'], 'date', 'format' => 'Y-m-d h:m:s'],
        ];
    }
}