<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\EntityDTO;

use function get_object_vars;

class ShopwareProductDTO implements EntityDTO
{
    public ?string $productId = null;
    public ?string $productNumber = null;
    public string $salesChannelName = 'Storefront';
    public int $stock;
    public ?string $taxId = null;
    public array $price = [];
    public ?bool $active = null;
    public ?string $name = null;
    public ?string $ean = null;
    public ?string $height = null;
    public ?string $length = null;
    public ?string $weight = null;
    public ?string $width = null;
    public ?string $description = null;
    public ?string $metaDescription = null;
    public ?string $manufacturerId = null;
    public array $categories = [];
    public array $properties = [];
    public array $customFields = [];
    public array $media = [];
    public array $cover = [];
    public bool $isCloseout = true;

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
