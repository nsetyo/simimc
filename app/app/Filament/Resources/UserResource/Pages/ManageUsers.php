<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUsers extends ManageRecords
{
    protected static string $resource = UserResource::class;

    /** @return array<int,Actions\Action> */
    protected function getActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
