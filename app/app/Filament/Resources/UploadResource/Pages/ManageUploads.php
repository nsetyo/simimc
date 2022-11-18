<?php

declare(strict_types=1);

namespace App\Filament\Resources\UploadResource\Pages;

use App\Filament\Resources\UploadResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

abstract class ManageUploads extends ManageRecords
{
    /** @var class-string<UploadResource> */
    protected static string $resource = UploadResource::class;

    protected function getTitle(): string
    {
        return static::$resource::getCategory()->label();
    }

    /** @return array<int,Actions\Action> */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();

                    $data['category'] = static::$resource::getCategory();

                    return $data;
                }),
        ];
    }
}
