<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Persister;

class ShopwareProductPersister implements Persister
{
    private $lastPersistedProduct;

    public function persist(EntityDTO $entity): void
    {
        // In a real implementation, this would save to Shopware's database
        $this->lastPersistedProduct = $entity;
    }

    public function getLastPersistedProduct(): ?ShopwareProductDTO
    {
        return $this->lastPersistedProduct;
    }
}
