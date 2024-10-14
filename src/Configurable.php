<?php

namespace Panakour\DataBridgeIo;

interface Configurable
{
    public function setConfiguration(Configuration $configuration): void;

    public function getConfiguration(): ?Configuration;
}
