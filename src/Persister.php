<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

interface Persister
{
    public function persist(EntityDTO $entity): void;
}
