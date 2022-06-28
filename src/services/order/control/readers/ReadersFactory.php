<?php

namespace mvorobiov\services\order\control\readers;


use mvorobiov\services\order\control\common\FactoryTrait;


class ReadersFactory
{
    use FactoryTrait;

    /**
     * @param string $type
     * @return IReader
     * @throws ReadersFactoryException
     * @throws \yii\base\InvalidConfigException
     */
    public function createByType(string $type): IReader {
        $className = $this->getClassName($type);

        if(!class_exists($className)) {
            $msg = sprintf('Unknown reader %s', $type);
            throw new ReadersFactoryException($msg);
        }

        if(!$this->isImplements($className, IReader::class)) {
            $msg = sprintf('Class %s must implement %s', $className, IReader::class);
            throw new ReadersFactoryException($msg);
        }

        return \Yii::createObject($className);
    }
}