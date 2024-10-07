<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface DataTransformer
{
    public function transform(array $data): EntityDTO;
}
