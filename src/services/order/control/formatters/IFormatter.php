<?php

namespace mvorobiov\services\order\control\formatters;


use mvorobiov\services\order\entity\ExternalOrder;
use mvorobiov\services\order\entity\RepresentableOrder;


interface IFormatter
{
    /**
     * @param string $orderRaw - raw orders string in required format
     * @return ExternalOrder[]
     */
    public function parse(string $orderRaw): array;

    /**
     * @param RepresentableOrder $order
     * @return string - raw orders string in required format
     */
    public function represent(RepresentableOrder $order): string;
}