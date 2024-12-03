<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo;

use Panakour\DataBridgeIo\EntityDTO;
use Panakour\DataBridgeIo\Importer;
use Panakour\DataBridgeIo\Persister;
use Panakour\DataBridgeIo\Transformer;
use Panakour\DataBridgeIo\Validator;

class ComponentsTest extends TestCase
{
    public function test_import_strategy(): void
    {
        $mockStrategy = new class implements Importer
        {
            public function import(): array
            {
                return ['test' => 'data'];
            }
        };

        $result = $mockStrategy->import();
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals('data', $result['test']);
    }

    public function test_validator(): void
    {
        $mockValidator = new class implements Validator
        {
            public function isValid(array $data): bool
            {
                return isset($data['valid']) && $data['valid'] === true;
            }
        };

        $this->assertTrue($mockValidator->isValid(['valid' => true]));
        $this->assertFalse($mockValidator->isValid(['valid' => false]));
        $this->assertFalse($mockValidator->isValid([]));
    }

    public function test_data_transformer(): void
    {
        $mockTransformer = new class implements Transformer
        {
            public function transform(array $data): EntityDTO
            {
                return new class implements EntityDTO
                {
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

    public function test_persister(): void
    {
        $mockPersister = new class implements Persister
        {
            public array $persistedData = [];

            public function persist(EntityDTO $entity): void
            {
                $this->persistedData = $entity->toArray();
            }
        };

        $mockEntity = new class implements EntityDTO
        {
            public function toArray(): array
            {
                return ['persisted' => 'data'];
            }
        };

        $mockPersister->persist($mockEntity);
        $this->assertEquals(['persisted' => 'data'], $mockPersister->persistedData);
    }
}
