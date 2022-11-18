<?php

declare(strict_types=1);

namespace App\Filament\Resources\Prodint\LaporanPeriodikResource\Pages;

use App\Filament\Resources\Prodint\LaporanPeriodikResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageLaporanPeriodiks extends ManageUploads
{
    protected static string $resource = LaporanPeriodikResource::class;
}
