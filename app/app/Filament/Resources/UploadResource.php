<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\Categories;
use App\Models\Upload;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class UploadResource extends Resource
{
    protected static string|null $model = Upload::class;

    protected static string|null $navigationIcon = 'heroicon-o-collection';

    abstract public static function getCategory(): Categories;

    public static function getNavigationLabel(): string
    {
        return Str::after(static::getCategory()->label(), ':: ');
    }

    public static function getSlug(): string
    {
        return Str::replace('::', '/', static::getCategory()->value);
    }

    /** @return array<string,array<int,mixed>> */
    public static function getPages(): array
    {
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('category', static::getCategory());
    }

    public static function form(Form $form): Form
    {
        return $form->columns(1)->schema([
            Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->required()
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->integer()
                        ->maxValue(now()->year))
                    ->translateLabel(),

            Forms\Components\FileUpload::make('path')
                ->label(__('File'))
                ->directory(static::getSlug())
                ->visibility('private')
                ->storeFileNamesIn('filename')
                ->required(),
            Forms\Components\MarkdownEditor::make('description')
                ->disableToolbarButtons([
                    'attachFiles',
                    'codeBlock',
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('uploader.name')
                    ->label('Uploader')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('year')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('filename')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->formatStateUsing(fn (string $state) => Str::of($state)
                        ->markdown()
                        ->toHtmlString())
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->url(fn (Upload $record): string => route('uploads.show', $record))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-cloud-download'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    protected static function getNavigationGroup(): string|null
    {
        return static::getCategory()->parent()->label();
    }
}
