<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface EntityDTO
{
    public function toArray(): array;
}
