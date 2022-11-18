<?php

declare(strict_types=1);

namespace App\Filament\Resources\Intelud;

use App\Enums\Categories;
use App\Filament\Resources\Intelud\DataKuatUdaraResource\Pages;
use App\Filament\Resources\UploadResource;

class DataKuatUdaraResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageDataKuatUdaras::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::INTELUD_DATA_KUAT_UDARA;
    }
}
