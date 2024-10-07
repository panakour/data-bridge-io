<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Sylius;

use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Transformer;

class SyliusProductTransformer implements Transformer
{
    public function transform(array $data): EntityDTO
    {
        $dto = new SyliusProductDataDTO;
        $dto->code = $data['code'] ?? '';
        $dto->name = $data['name'] ?? '';
        $dto->description = $data['description'] ?? '';

        return $dto;
    }
}
