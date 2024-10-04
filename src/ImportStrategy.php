<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface ImportStrategy
{
    /**
     * @return array<string, mixed>
     */
    public function import(): array;
}
