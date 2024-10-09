<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo;

use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Importer;
use Panakour\DataBridgeIo\ImportFacade;
use Panakour\DataBridgeIo\Persister;
use Panakour\DataBridgeIo\Transformer;

class ImportFacadeTest extends TestCase
{
    private $mockStrategy;

    private $mockTransformer;

    private $mockPersister;

    private $importFacade;

    protected function setUp(): void
    {
        $this->mockStrategy = $this->createMock(Importer::class);
        $this->mockTransformer = $this->createMock(Transformer::class);
        $this->mockPersister = $this->createMock(Persister::class);

        $this->importFacade = new ImportFacade(
            $this->mockStrategy,
            $this->mockTransformer,
            $this->mockPersister,
        );
    }

    public function testExecuteImport()
    {
        $importData = [
            ['item' => 'test'],
            ['item2' => 'test2'],
        ];
        $mockEntityDTO = $this->createMock(EntityDTO::class);

        $this->mockStrategy->expects($this->once())
            ->method('import')
            ->willReturn($importData);

        $this->mockTransformer->expects($this->exactly(2))
            ->method('transform')
            ->willReturn($mockEntityDTO);

        $this->mockPersister->expects($this->exactly(2))
            ->method('persist');

        $this->importFacade->executeImport();
    }
}
