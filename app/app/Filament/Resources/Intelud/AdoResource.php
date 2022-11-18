<?php

declare(strict_types=1);

namespace App\Filament\Resources\Intelud;

use App\Enums\Categories;
use App\Filament\Resources\Intelud\AdoResource\Pages;
use App\Filament\Resources\UploadResource;

class AdoResource extends UploadResource
{
    /** @return array<string,array<int,mixed>> */
    public static function getPages(): array
    {
        return ['index' => Pages\ManageAdos::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::INTELUD_ADO;
    }
}
