<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo;

use Panakour\DataBridgeIo\DataTransformer;
use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\ImportFacade;
use Panakour\DataBridgeIo\ImportStrategy;
use Panakour\DataBridgeIo\Persister;

class ImportFacadeTest extends TestCase
{
    private $mockStrategy;
    private $mockTransformer;
    private $mockPersister;
    private $importFacade;

    protected function setUp(): void
    {
        $this->mockStrategy = $this->createMock(ImportStrategy::class);
        $this->mockTransformer = $this->createMock(DataTransformer::class);
        $this->mockPersister = $this->createMock(Persister::class);

        $this->importFacade = new ImportFacade(
            $this->mockStrategy,
            $this->mockTransformer,
            $this->mockPersister,
        );
    }

    public function testExecuteImport()
    {
        $importData = ['raw' => 'data'];
        $mockEntityDTO = $this->createMock(EntityDTO::class);

        $this->mockStrategy->expects($this->once())
            ->method('import')
            ->willReturn($importData);

        $this->mockTransformer->expects($this->once())
            ->method('transform')
            ->with($this->equalTo($importData))
            ->willReturn($mockEntityDTO);

        $this->mockPersister->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($mockEntityDTO));

        $this->importFacade->executeImport();
    }
}
