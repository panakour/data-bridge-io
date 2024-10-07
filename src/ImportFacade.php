<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

class ImportFacade
{
    public function __construct(
        private ImportStrategy $strategy,
        private DataTransformer $dataTransformer,
        private Persister $persister,
    ) {}

    public function executeImport(): void
    {
        $data = $this->strategy->import();
        $entityDto = $this->dataTransformer->transform($data);
        $this->persister->persist($entityDto);
    }
}
