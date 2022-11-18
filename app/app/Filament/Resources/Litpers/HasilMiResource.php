<?php

declare(strict_types=1);

namespace App\Filament\Resources\Litpers;

use App\Enums\Categories;
use App\Filament\Resources\Litpers\HasilMiResource\Pages;
use App\Filament\Resources\UploadResource;

class HasilMiResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageHasilMis::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::LITPERS_HASIL_MI;
    }
}
