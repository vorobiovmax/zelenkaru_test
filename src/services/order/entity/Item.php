<?php

namespace mvorobiov\services\order\entity;


use yii\base\Model;


/**
 * @property integer $id
 * @property string $name
 * @property string|null $manufacturer
 * @property string|null $barcodes
 * @property string $quantity
 * @property float $price
 * @property float $amount
 */
class Item extends Model
{
    public int $id;
    public string $name;
    public ?string $manufacturer;
    public ?string $barcodes;
    public string $quantity;
    public float $price;
    public float $amount;

    public function rules(): array {
        return [
            [['id', 'name', 'quantity', 'price', 'amount'], 'required'],
            [['quantity', 'price', 'amount'], 'number'],
        ];
    }
}