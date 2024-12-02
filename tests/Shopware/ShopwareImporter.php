<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Configurable;
use Panakour\DataBridgeIo\ConfigurableTrait;
use Panakour\DataBridgeIo\Importer;

class ShopwareImporter implements Configurable, Importer
{
    use ConfigurableTrait;

    public function import(): array
    {
        $apiUrl = $this->configuration ? $this->configuration->get('api_url',
            'https://default-api.com') : 'https://default-api.com';

        return [
            [
                'productNumber' => 'SW001',
                'name' => 'Test Product',
                'price' => [['currencyId' => 'EUR', 'gross' => 19.99, 'net' => 16.80, 'linked' => true]],
                'stock' => 100,
                'isActive' => true,
            ],
            [
                'productNumber' => 'SW002',
                'name' => 'Test Product 2',
                'price' => [['currencyId' => 'EUR', 'gross' => 29.99, 'net' => 26.80, 'linked' => true]],
                'stock' => 0,
                'isActive' => true,
            ],
        ];
    }
}
