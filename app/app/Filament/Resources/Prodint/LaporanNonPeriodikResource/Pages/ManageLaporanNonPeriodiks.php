<?php

declare(strict_types=1);

namespace App\Filament\Resources\Prodint\LaporanNonPeriodikResource\Pages;

use App\Filament\Resources\Prodint\LaporanNonPeriodikResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageLaporanNonPeriodiks extends ManageUploads
{
    protected static string $resource = LaporanNonPeriodikResource::class;
}
