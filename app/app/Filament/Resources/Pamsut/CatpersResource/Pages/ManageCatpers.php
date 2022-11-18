<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pamsut\CatpersResource\Pages;

use App\Filament\Resources\Pamsut\CatpersResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageCatpers extends ManageUploads
{
    protected static string $resource = CatpersResource::class;
}
