<?php

namespace mvorobiov\services\order\control\storages;


use mvorobiov\models\Order;
use mvorobiov\services\order\entity\ExternalOrder;
use mvorobiov\services\order\entity\RepresentableOrder;


class LocalDatabase implements IRepository
{
    protected OrderMapper $mapper;

    /**
     * @param OrderMapper $mapper
     */
    public function __construct(OrderMapper $mapper) {
        $this->mapper = $mapper;
    }

    public function findByRealId(int $realId): ?RepresentableOrder {
        $record = Order::findOne(['real_id' => $realId]);

        if(!$record) {
            return null;
        }

        return $this->mapper->mapRecordToRepresentable($record);
    }

    public function save(ExternalOrder $external): bool {
        $existingRecord = Order::findOne(['real_id' => $external->real_id]);

        $record = $this->mapper->mapExternalToRecord($external, $existingRecord);

        return $record->save();
    }
}