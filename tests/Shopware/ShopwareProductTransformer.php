<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Configurable;
use Panakour\DataBridgeIo\ConfigurableTrait;
use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Transformer;

class ShopwareProductTransformer implements Configurable, Transformer
{
    use ConfigurableTrait;

    public function transform(array $data): EntityDTO
    {
        $dto = new ShopwareProductDTO;
        $dto->productNumber = $data['productNumber'] ?? null;
        $dto->name = $data['name'] ?? null;
        $dto->price = $data['price'] ?? [];
        $dto->stock = $data['stock'] ?? 0;
        $dto->active = $data['isActive'];

        return $dto;
    }
}
