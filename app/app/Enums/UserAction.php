<?php

declare(strict_types=1);

namespace App\Enums;

use function Psl\Dict\from_keys;
use function Psl\Dict\map;

enum UserAction: string
{
    case READ          = 'read';
    case CREATE_UPDATE = 'create&update';
    case DELETE        = 'delete';

    /** @return array<string,string> */
    public static function casesWithLabel(): array
    {
        return from_keys(
            map(self::cases(), fn (self $action) => $action->value),
            fn ($key) => __('action.' . $key)
        );
    }
}
