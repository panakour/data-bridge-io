<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Configurable;
use Panakour\DataBridgeIo\ConfigurableTrait;
use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Persister;

class ShopwareProductPersister implements Configurable, Persister
{
    use ConfigurableTrait;

    private array $persitedItems = [];

    private $lastPersistedProduct;

    public function persist(EntityDTO $entity): void
    {
        $this->persitedItems[] = $entity;
        $this->lastPersistedProduct = $entity;
    }

    public function getLastPersistedProduct(): ?ShopwareProductDTO
    {
        return $this->lastPersistedProduct;
    }

    public function getPersitedItems(): array
    {
        return $this->persitedItems;
    }
}
