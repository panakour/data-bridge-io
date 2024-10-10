<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

class DataBridge
{
    public function __construct(
        private Importer $importer,
        private Transformer $transformer,
        private Persister $persister,
        private ?Configuration $configuration = null
    ) {
        $this->injectConfiguration();
    }

    private function injectConfiguration(): void
    {
        if ($this->configuration) {
            if ($this->importer instanceof ConfigurableImporter) {
                $this->importer->setConfiguration($this->configuration);
            }
        }
    }

    public function process(): void
    {
        $data = $this->importer->import();
        foreach ($data as $item) {
            $entityDto = $this->transformer->transform($item);
            $this->persister->persist($entityDto);
        }
    }
}
