<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface DataTransformer
{
    /**
     * @param array<string, mixed> $data
     */
    public function transform(array $data): EntityDTO;
}
