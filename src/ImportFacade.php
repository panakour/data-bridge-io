<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

class ImportFacade
{
    public function __construct(
        private Importer $strategy,
        private Transformer $dataTransformer,
        private Persister $persister,
    ) {}

    public function executeImport(): void
    {
        $data = $this->strategy->import();
        foreach ($data as $item) {
            $entityDto = $this->dataTransformer->transform($item);
            $this->persister->persist($entityDto);
        }
    }
}
