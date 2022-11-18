<?php

declare(strict_types=1);

namespace App\Filament\Resources\Binprof;

use App\Enums\Categories;
use App\Filament\Resources\Binprof\BahanAjarResource\Pages;
use App\Filament\Resources\UploadResource;

class BahanAjarResource extends UploadResource
{
    public static function getPages(): array
    {
        return ['index' => Pages\ManageBahanAjars::route('/')];
    }

    public static function getCategory(): Categories
    {
        return Categories::BINPROF_BAHAN_AJAR;
    }
}
