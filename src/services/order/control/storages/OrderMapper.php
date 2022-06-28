<?php

namespace mvorobiov\services\order\control\storages;


use mvorobiov\models\Order;
use mvorobiov\services\order\entity\ExternalOrder;
use mvorobiov\services\order\entity\RepresentableOrder;


class OrderMapper
{
    /**
     * @param ExternalOrder $external
     * @param Order|null $record
     * @return Order
     */
    public function mapExternalToRecord(ExternalOrder $external, ?Order $record = null): Order {
        $record = $record ?? new Order();

        $record->real_id = $external->id;
        $record->user_name = $external->user_name;
        $record->user_phone = $external->user_phone;
        $record->warehouse_id = $external->warehouse_id;
        $record->created_at = \Yii::$app->formatter->asTimestamp($external->created_at);
        $record->updated_at = 0;
        $record->status = $external->status;
        $record->items_count = count($external->items);

        return $record;
    }

    /**
     * @param Order $record
     * @return RepresentableOrder
     * @throws \yii\base\InvalidConfigException
     */
    public function mapRecordToRepresentable(Order $record): RepresentableOrder {
        $representable = new RepresentableOrder();

        $representable->id = $record->id;
        $representable->real_id = $record->real_id;
        $representable->user_name = $record->user_name;
        $representable->user_phone = $record->user_phone;
        $representable->warehouse_id = $record->warehouse_id;
        $representable->created_at = \Yii::$app->formatter->asDatetime($record->created_at, 'php:Y-m-d h:i:s');
        $representable->updated_at = \Yii::$app->formatter->asDatetime($record->updated_at, 'php:Y-m-d H:i:s');
        $representable->status = $record->status;
        $representable->items_count = $record->items_count;

        return $representable;
    }
}