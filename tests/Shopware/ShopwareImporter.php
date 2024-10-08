<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\ConfigurableImporter;
use Panakour\DataBridgeIo\Configuration;

class ShopwareImporter implements ConfigurableImporter
{
    public ?Configuration $configuration = null;

    public function setConfiguration(Configuration $configuration): void
    {
        $this->configuration = $configuration;
        $this->configuration->set('last_modification', '2024-10-09T15:00:00');
    }

    public function import(): array
    {
        $apiUrl = $this->configuration ? $this->configuration->get('api_url', 'https://default-api.com') : 'https://default-api.com';
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
            ]
        ];
    }
}
