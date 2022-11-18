<?php

declare(strict_types=1);

namespace App\Filament\Resources\Binprof;

use App\Enums\Categories;
use App\Filament\Resources\Binprof\DataPersonelResource\Pages;
use App\Filament\Resources\UploadResource;

class DataPersonelResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageDataPersonels::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::BINPROF_DATA_PERSONEL;
    }
}
