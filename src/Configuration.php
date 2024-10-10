<?php

declare(strict_types=1);

namespace Panakour\DataBridgeIo;

final class Configuration
{
    public function __construct(private array $settings = [])
    {
    }

    public function get(string $key, $default = null): mixed
    {
        return $this->settings[$key] ?? $default;
    }

    public function set(string $key, $value): void
    {
        $this->settings[$key] = $value;
    }
}
