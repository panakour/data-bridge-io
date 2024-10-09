<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

class ImportFacade
{
    public function __construct(
        private Importer $importer,
        private Transformer $transformer,
        private Persister $persister,
    ) {}

    public function executeImport(): void
    {
        $data = $this->importer->import();
        foreach ($data as $item) {
            $entityDto = $this->transformer->transform($item);
            $this->persister->persist($entityDto);
        }
    }
}
