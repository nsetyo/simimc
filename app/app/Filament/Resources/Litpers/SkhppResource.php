<?php

declare(strict_types=1);

namespace App\Filament\Resources\Litpers;

use App\Enums\Categories;
use App\Filament\Resources\Litpers\SkhppResource\Pages;
use App\Filament\Resources\UploadResource;

class SkhppResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageSkhpps::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::LITPERS_SKHPP;
    }
}
