<?php

declare(strict_types=1);

namespace App\Filament\Resources\Intelud\AdoResource\Pages;

use App\Filament\Resources\Intelud\AdoResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageAdos extends ManageUploads
{
    protected static string $resource = AdoResource::class;
}
