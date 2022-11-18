<?php

declare(strict_types=1);

use App\Enums\JenisTindakLanjut;
use App\Enums\SystemRole;

return [
    SystemRole::class        => [
        SystemRole::ADMINISTRATOR => 'Administrator PPATK',
    ],
    JenisTindakLanjut::class => [
        JenisTindakLanjut::DITEMUKAN_DI_SIPENDAR => 'Ditemukan di SIPENDAR',
    ],
];
