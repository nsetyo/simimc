<?php

declare(strict_types=1);

namespace App\Filament\Resources\Intelud;

use App\Enums\Categories;
use App\Filament\Resources\Intelud\FscResource\Pages;
use App\Filament\Resources\UploadResource;

class FscResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageFscs::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::INTELUD_FSC;
    }
}
