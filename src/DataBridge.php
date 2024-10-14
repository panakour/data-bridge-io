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
        if ($this->configuration === null) {
            return;
        }

        if ($this->importer instanceof Configurable) {
            $this->importer->setConfiguration($this->configuration);
        }

        if ($this->transformer instanceof Configurable) {
            $this->transformer->setConfiguration($this->configuration);
        }

        if ($this->persister instanceof Configurable) {
            $this->persister->setConfiguration($this->configuration);
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
