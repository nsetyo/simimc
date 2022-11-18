<?php

declare(strict_types=1);

namespace App\Filament\Resources\Binprof\DataPersonelResource\Pages;

use App\Filament\Resources\Binprof\DataPersonelResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageDataPersonels extends ManageUploads
{
    protected static string $resource = DataPersonelResource::class;
}
