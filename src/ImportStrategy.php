<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface ImportStrategy
{
    public function import(): array;
}
