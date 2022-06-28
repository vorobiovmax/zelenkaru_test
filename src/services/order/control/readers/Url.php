<?php

namespace mvorobiov\services\order\control\readers;


use mvorobiov\services\order\entity\Content;
use yii\httpclient\Client;


class Url implements IReader
{
    public function getContent(string $path): Content {
        $client = new Client();

        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($path)
            ->send();

        if(!$response->isOk) {
            $msg = sprintf('Unable to get content from %s', $path);
            throw new ReaderException($msg);
        }

        return new Content($response->getFormat(), $response->getContent());
    }
}