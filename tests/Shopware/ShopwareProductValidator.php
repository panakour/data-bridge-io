<?php

declare(strict_types=1);

namespace Panakour\Test\DataBridgeIo\Shopware;

use Panakour\DataBridgeIo\Validator;

class ShopwareProductValidator implements Validator
{
    public function isValid(array $data): bool
    {
        if (! isset($data['productNumber']) || empty(trim($data['productNumber']))) {
            return false;
        }
        if (! isset($data['name']) || empty(trim($data['name']))) {
            return false;
        }

        return true;
    }
}
