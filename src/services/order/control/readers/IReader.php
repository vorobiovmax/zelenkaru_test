<?php

namespace mvorobiov\services\order\control\readers;


use mvorobiov\services\order\entity\Content;


interface IReader
{
    /**
     * @param string $path
     * @return Content
     */
    public function getContent(string $path): Content;
}