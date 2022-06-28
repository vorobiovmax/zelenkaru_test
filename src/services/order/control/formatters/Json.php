<?php

namespace mvorobiov\services\order\control\formatters;


use mvorobiov\services\order\entity\ExternalOrder;
use mvorobiov\services\order\entity\Item;
use mvorobiov\services\order\entity\RepresentableOrder;


class Json implements IFormatter
{
    /**
     * @param string $orderRaw
     * @return array
     * @throws FormatterException
     */
    public function parse(string $orderRaw): array {
        $data = \yii\helpers\Json::decode($orderRaw);

        $data = $data['orders'] ?? null;

        if(empty($data)) {
            return [];
        }

        $orders = [];

        foreach ($data as $orderFields) {
            $rawItems = $orderFields['items'];

            if (empty($rawItems)) {
                $rawItems = [];
            }

            if(!is_array($rawItems)) {
                throw new FormatterException('Invalid argument "items" for order');
            }

            $orderFields['items'] = $this->processRawItems($rawItems);
            $orderFields['warehouse_id'] = (int)$orderFields['warehouse_id'];

            $order = new ExternalOrder($orderFields);

            if(!$order->validate()) {
                //Usually we should only rely on valid data and throw an exception
                //Just skipping if there is broken data in the test source
                continue;

                //$msg = sprintf('Invalid order. %s', implode('. ', $order->getFirstErrors()));
                //throw new FormatterException($msg);
            }

            $orders[] = $order;
        }

        return $orders;
    }

    /**
     * @param RepresentableOrder $order
     * @return string
     */
    public function represent(RepresentableOrder $order): string {
        return \yii\helpers\Json::encode($order->toArray(), JSON_PRETTY_PRINT);
    }

    /**
     * @param array $rawItems
     * @return Item[]
     * @throws FormatterException
     */
    protected function processRawItems(array $rawItems): array {
        $items = [];

        foreach ($rawItems as $itemFields) {
            if(!is_array($itemFields)) {
                $msg = sprintf('Cant recognize item from %s', gettype($itemFields));

                throw new FormatterException($msg);
            }

            $item = new Item($itemFields);

            if(!$item->validate()) {
                $msg = sprintf('Invalid order\'s item. %s', implode('. ', $item->getFirstErrors()));

                throw new FormatterException($msg);
            }

            $items[] = $item;
        }

        return $items;
    }
}