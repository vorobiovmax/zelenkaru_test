<?php

namespace mvorobiov\services\order\control\formatters;


use mvorobiov\services\order\control\common\FactoryTrait;


class FormattersFactory
{
    use FactoryTrait;

    /**
     * @param string $type
     * @return IFormatter
     * @throws FormattersFactoryException
     * @throws \yii\base\InvalidConfigException
     */
    public function createByType(string $type): IFormatter {
        $className = $this->getClassName($type);

        if(!class_exists($className)) {
            $msg = sprintf('Unknown type %s for order format', $type);
            throw new FormattersFactoryException($msg);
        }

        if(!$this->isImplements($className, IFormatter::class)) {
            $msg = sprintf('Class %s must implement %s', $className, IFormatter::class);
            throw new FormattersFactoryException($msg);
        }

        return \Yii::createObject($className);
    }
}