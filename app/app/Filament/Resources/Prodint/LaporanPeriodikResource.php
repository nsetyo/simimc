<?php

declare(strict_types=1);

namespace App\Filament\Resources\Prodint;

use App\Enums\Categories;
use App\Filament\Resources\Prodint\LaporanPeriodikResource\Pages;
use App\Filament\Resources\UploadResource;

class LaporanPeriodikResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageLaporanPeriodiks::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::PRODINT_LAP_PERIODIK;
    }
}
