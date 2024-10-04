<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Sylius;

use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Persister;

class SyliusProductPersister implements Persister
{
    private $lastPersistedProduct;

    public function persist(EntityDTO $entity): void
    {
        // In a real implementation, this would save to Sylius's database
        $this->lastPersistedProduct = $entity;
    }

    public function getLastPersistedProduct(): ?SyliusProductDataDTO
    {
        return $this->lastPersistedProduct;
    }
}
