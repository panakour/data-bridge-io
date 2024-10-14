<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

trait ConfigurableTrait
{
    protected ?Configuration $configuration = null;

    public function setConfiguration(Configuration $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): ?Configuration
    {
        return $this->configuration;
    }
}
