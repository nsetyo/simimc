<?php

declare(strict_types=1);

namespace App\Filament\Resources\Pamsut;

use App\Enums\Categories;
use App\Filament\Resources\Pamsut\CatpersResource\Pages;
use App\Filament\Resources\UploadResource;

class CatpersResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageCatpers::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::PAMSUT_CATPERS;
    }
}
