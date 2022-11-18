<?php

declare(strict_types=1);

namespace App\Filament\Resources\Litpers\ScMitraResource\Pages;

use App\Filament\Resources\Litpers\ScMitraResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageScMitras extends ManageUploads
{
    protected static string $resource = ScMitraResource::class;
}
