<?php

namespace mvorobiov\services\order\control\storages;


use mvorobiov\services\order\control\common\FactoryTrait;
use mvorobiov\services\order\control\storages\IRepository;


class RepositoryFactory
{
    use FactoryTrait;

    /**
     * @param string $type
     * @return \mvorobiov\services\order\control\storages\IRepository
     * @throws RepositoryFactoryException
     * @throws \yii\base\InvalidConfigException
     */
    public function createByType(string $type): IRepository {
        $className = $this->getClassName($type);

        if(!class_exists($className)) {
            $msg = sprintf('Unknown repository %s', $type);
            throw new RepositoryFactoryException($msg);
        }

        if(!$this->isImplements($className, IRepository::class)) {
            $msg = sprintf('Class %s must implement %s', $className, IRepository::class);
            throw new RepositoryFactoryException($msg);
        }

        return \Yii::createObject($className);
    }
}