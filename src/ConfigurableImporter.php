<?php

namespace Panakour\DataBridgeIo;

interface ConfigurableImporter extends Importer
{
    public function setConfiguration(Configuration $configuration): void;
}
