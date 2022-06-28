<?php

namespace mvorobiov\services\order\entity;


class Content
{
    public string $type;
    public string $output;

    public function __construct(string $type, string $output) {
        $this->type = $type;
        $this->output = $output;
    }
}