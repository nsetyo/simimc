<?php

declare(strict_types=1);

namespace App\Filament\Resources\Imc\LaporanAnalisaMediaResource\Pages;

use App\Filament\Resources\Imc\LaporanAnalisaMediaResource;
use App\Filament\Resources\UploadResource\Pages\ManageUploads;

class ManageLaporanAnalisaMedia extends ManageUploads
{
    protected static string $resource = LaporanAnalisaMediaResource::class;
}
