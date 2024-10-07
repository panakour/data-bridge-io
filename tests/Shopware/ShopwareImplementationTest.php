<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Importer;
use Panakour\DataBridgeIo\ImportFacade;
use Panakour\Test\DataBridgeIo\TestCase;

class ShopwareImplementationTest extends TestCase
{
    private $mockStrategy;

    private $shopwareTransformer;

    private $shopwarePersister;

    private $importFacade;

    protected function setUp(): void
    {
        $this->mockStrategy = $this->createMock(Importer::class);
        $this->shopwareTransformer = new ShopwareProductTransformer;
        $this->shopwarePersister = new ShopwareProductPersister;

        $this->importFacade = new ImportFacade(
            $this->mockStrategy,
            $this->shopwareTransformer,
            $this->shopwarePersister,
        );
    }

    public function testShopwareProductImport()
    {
        $importData = [
            'productNumber' => 'SW001',
            'name' => 'Test Product',
            'price' => [['currencyId' => 'EUR', 'gross' => 19.99, 'net' => 16.80, 'linked' => true]],
            'stock' => 100,
            'isActive' => true,
        ];

        $this->mockStrategy->expects($this->once())
            ->method('import')
            ->willReturn($importData);

        $this->importFacade->executeImport();

        $persistedProduct = $this->shopwarePersister->getLastPersistedProduct();
        $this->assertInstanceOf(ShopwareProductDTO::class, $persistedProduct);
        $this->assertEquals('SW001', $persistedProduct->productNumber);
        $this->assertEquals('Test Product', $persistedProduct->name);
        $this->assertEquals(100, $persistedProduct->stock);
        $this->assertEquals([['currencyId' => 'EUR', 'gross' => 19.99, 'net' => 16.80, 'linked' => true]], $persistedProduct->price);
        $this->assertEquals(true, $persistedProduct->active);
    }
}
