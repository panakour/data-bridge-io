<?php

namespace Panakour\DataBridgeIo;

interface Validator
{
    public function isValid(array $data): bool;
}
