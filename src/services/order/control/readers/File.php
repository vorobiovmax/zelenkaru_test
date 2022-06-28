<?php

namespace mvorobiov\services\order\control\readers;


use mvorobiov\services\order\entity\Content;


class File implements IReader
{
    public function getContent(string $path): Content {
        if(!file_exists($path)) {
            $msg = sprintf('Unable to get content from %s', $path);
            throw new ReaderException($msg);
        }

        return new Content(pathinfo($path, PATHINFO_EXTENSION), file_get_contents($path));
    }
}