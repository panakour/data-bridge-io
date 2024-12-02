<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Sylius;

use Panakour\DataBridgeIo\DataBridge;
use Panakour\DataBridgeIo\Importer;
use Panakour\Test\DataBridgeIo\TestCase;

class SyliusImplementationTest extends TestCase
{
    private $mockStrategy;

    private $syliusTransformer;

    private $syliusPersister;

    private $bridge;

    protected function setUp(): void
    {
        $this->mockStrategy = $this->createMock(Importer::class);
        $this->syliusTransformer = new SyliusProductTransformer;
        $this->syliusPersister = new SyliusProductPersister;

        $this->bridge = new DataBridge(
            $this->mockStrategy,
            $this->syliusTransformer,
            $this->syliusPersister,
        );
    }

    public function test_sylius_product_import()
    {
        $importData = [
            [
                'code' => 'SY001',
                'name' => 'Test Sylius Product',
                'description' => 'This is a test product for Sylius',
                'price' => 29.99,
            ],
        ];

        $this->mockStrategy->expects($this->once())
            ->method('import')
            ->willReturn($importData);

        $this->bridge->process();

        $persistedProduct = $this->syliusPersister->getLastPersistedProduct();
        $this->assertInstanceOf(SyliusProductDataDTO::class, $persistedProduct);
        $this->assertEquals('SY001', $persistedProduct->code);
        $this->assertEquals('Test Sylius Product', $persistedProduct->name);
        $this->assertEquals('This is a test product for Sylius', $persistedProduct->description);
    }
}
