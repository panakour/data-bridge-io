<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo;

use Panakour\DataBridgeIo\DataTransformer;
use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\ImportStrategy;
use Panakour\DataBridgeIo\Persister;

class ComponentsTest extends TestCase
{
    public function testImportStrategy()
    {
        $mockStrategy = new class implements ImportStrategy {
            public function import(): array
            {
                return ['test' => 'data'];
            }
        };

        $result = $mockStrategy->import();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals('data', $result['test']);
    }

    public function testDataTransformer()
    {
        $mockTransformer = new class implements DataTransformer {
            public function transform(array $data): EntityDTO
            {
                return new class implements EntityDTO {
                    public function toArray(): array
                    {
                        return ['transformed' => 'data'];
                    }
                };
            }
        };

        $result = $mockTransformer->transform(['raw' => 'data']);
        $this->assertInstanceOf(EntityDTO::class, $result);
        $this->assertEquals(['transformed' => 'data'], $result->toArray());
    }

    public function testPersister()
    {
        $mockPersister = new class implements Persister {
            public $persistedData;

            public function persist(EntityDTO $entity): void
            {
                $this->persistedData = $entity->toArray();
            }
        };

        $mockEntity = new class implements EntityDTO {
            public function toArray(): array
            {
                return ['persisted' => 'data'];
            }
        };

        $mockPersister->persist($mockEntity);
        $this->assertEquals(['persisted' => 'data'], $mockPersister->persistedData);
    }
}
