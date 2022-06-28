<?php

namespace mvorobiov\services\order\control\storages;


use mvorobiov\models\Order;
use mvorobiov\services\order\entity\ExternalOrder;
use mvorobiov\services\order\entity\RepresentableOrder;


interface IRepository
{
    /**
     * @param int $realId
     * @return RepresentableOrder|null
     */
    public function findByRealId(int $realId): ?RepresentableOrder;

    /**
     * @param ExternalOrder $external
     * @return bool
     */
    public function save(ExternalOrder $external): bool;
}