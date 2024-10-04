<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Sylius;

use Panakour\DataBridgeIo\EntityDTO;

use function get_object_vars;

class SyliusProductDataDTO implements EntityDTO
{
    public string $defaultLocale = 'en_US';
    public string $defaultChannel = 'default';
    public string $code;
    public bool $configurable = false;
    public string $variantSelectionMethod = 'choice';
    public string $name;
    public ?string $slug = null;
    public ?string $brand = null;
    public ?string $category = null;
    public string $description = '';
    public string $shortDescription = '';
    public string $metaDescription = '';
    public string $metaKeywords = '';
    public array $attributes = [];
    public array $variations = [];

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
