<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Configuration;
use Panakour\DataBridgeIo\DataBridge;
use Panakour\Test\DataBridgeIo\TestCase;

class ShopwareImplementationTest extends TestCase
{
    private ShopwareImporter $shopwareImporter;

    private ShopwareProductTransformer $shopwareTransformer;

    private ShopwareProductPersister $shopwarePersister;

    private ShopwareProductValidator $shopwareValidator;

    private DataBridge $bridge;

    private Configuration $configuration;

    protected function setUp(): void
    {
        $this->configuration = new Configuration([
            'api_url' => 'https://test-api.com', 'last_modification' => '2024-10-09T15:00:00',
        ]);
        $this->shopwareImporter = new ShopwareImporter;
        $this->shopwareTransformer = new ShopwareProductTransformer;
        $this->shopwarePersister = new ShopwareProductPersister;
        $this->shopwareValidator = new ShopwareProductValidator;

        $this->bridge = new DataBridge(
            $this->shopwareImporter,
            $this->shopwareTransformer,
            $this->shopwarePersister,
            $this->configuration,
            $this->shopwareValidator
        );
    }

    public function test_shopware_product_import()
    {
        $this->bridge->process();

        $this->assertEquals('https://test-api.com', $this->shopwareImporter->getConfiguration()->get('api_url'));
        $this->assertEquals('2024-10-09T15:00:00', $this->shopwareImporter->getConfiguration()->get('last_modification'));

        $persistedProduct = $this->shopwarePersister->getLastPersistedProduct();
        $this->assertInstanceOf(ShopwareProductDTO::class, $persistedProduct);
        $this->assertEquals('SW002', $persistedProduct->productNumber);
        $this->assertEquals('Test Product 2', $persistedProduct->name);
        $this->assertEquals(0, $persistedProduct->stock);
        $this->assertEquals([['currencyId' => 'EUR', 'gross' => 29.99, 'net' => 26.80, 'linked' => true]],
            $persistedProduct->price);
        $this->assertEquals(true, $persistedProduct->active);
    }

    public function test_shopware_product_import_not_include_invalid_items()
    {
        $this->bridge->process();

        $persistedProduct = $this->shopwarePersister->getPersitedItems();
        $this->assertNotEmpty($persistedProduct);
        $this->assertCount(2, $persistedProduct);
    }
}
