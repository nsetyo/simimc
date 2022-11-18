<?php

declare(strict_types=1);

namespace App\Filament\Resources\Prodint;

use App\Enums\Categories;
use App\Filament\Resources\Prodint\BukuPetunjukResource\Pages;
use App\Filament\Resources\UploadResource;

class BukuPetunjukResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageBukuPetunjuks::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::PRODINT_BUKU_PETUNJUK;
    }
}
