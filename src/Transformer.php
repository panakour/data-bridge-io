<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface Transformer
{
    public function transform(array $data): EntityDTO;
}
