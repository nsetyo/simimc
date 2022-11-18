<?php

declare(strict_types=1);

namespace App\Filament\Resources\Litpers;

use App\Enums\Categories;
use App\Filament\Resources\Litpers\ScMitraResource\Pages;
use App\Filament\Resources\UploadResource;

class ScMitraResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageScMitras::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::LITPERS_SC_MITRA;
    }
}
