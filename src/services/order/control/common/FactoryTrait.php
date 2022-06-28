<?php

namespace mvorobiov\services\order\control\common;


use yii\helpers\StringHelper;


trait FactoryTrait
{
    /**
     * @param string $type
     * @return string
     */
    protected function getClassName(string $type): string {
        $namespace = get_class($this);
        $namespace = mb_substr($namespace, 0, mb_strripos($namespace, '\\'));

        return $namespace . '\\' . StringHelper::mb_ucfirst($type);
    }

    /**
     * @param string $className
     * @param string $interfaceName
     * @return bool
     */
    protected function isImplements(string $className, string $interfaceName): bool {
        $contracts = class_implements($className);

        return is_array($contracts) && in_array($interfaceName, $contracts);
    }
}