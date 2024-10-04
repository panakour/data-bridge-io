<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface EntityDTO
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
