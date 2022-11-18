<?php

declare(strict_types=1);

namespace App\Filament\Resources\Imc;

use App\Enums\Categories;
use App\Filament\Resources\Imc\LaporanAnalisaMediaResource\Pages;
use App\Filament\Resources\UploadResource;

class LaporanAnalisaMediaResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageLaporanAnalisaMedia::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::IMC_LAP_ANALISIS_MEDIA;
    }
}
