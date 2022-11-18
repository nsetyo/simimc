<?php

declare(strict_types=1);

namespace App\Filament\Resources\Prodint;

use App\Enums\Categories;
use App\Filament\Resources\Prodint\LaporanNonPeriodikResource\Pages;
use App\Filament\Resources\UploadResource;

class LaporanNonPeriodikResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageLaporanNonPeriodiks::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::PRODINT_LAP_NON_PERIODIK;
    }
}
