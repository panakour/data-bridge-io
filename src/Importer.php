<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface Importer
{
    public function import(): array;
}
