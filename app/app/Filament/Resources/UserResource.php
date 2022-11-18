<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\Categories;
use App\Enums\UserAction;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

use function Psl\Dict\map;

class UserResource extends Resource
{
    public const PASS_PLACEHOLDER = '_********_';

    protected static string|null $model = User::class;

    protected static string|null $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->translateLabel(),
            Forms\Components\TextInput::make('nrp')
                ->label('NRP')
                ->required(),
            Forms\Components\TextInput::make('occupation')
                ->required()
                ->translateLabel(),
            Forms\Components\TextInput::make('password')
                ->confirmed()
                ->password()
                ->required()
                ->translateLabel(),
            Forms\Components\TextInput::make('password_confirmation')
                ->translateLabel()
                ->password()
                ->dehydrated(false),
            Forms\Components\Fieldset::make('Permissions')
                ->columnSpanFull()
                ->columns(3)
                ->schema(map(Categories::cases(), function (Categories $cat) {
                    return CheckboxList::make('permissions.' . $cat->value)
                        ->label($cat->label())
                        ->options(UserAction::casesWithLabel())
                        ->translateLabel();
                })),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->translateLabel(),
            Tables\Columns\TextColumn::make('nrp')
                ->searchable()
                ->label('NRP'),
            Tables\Columns\TextColumn::make('occupation')
                ->searchable()
                ->translateLabel(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make()
                ->mutateRecordDataUsing(function (array $data) {
                    $data['password'] = self::PASS_PLACEHOLDER;
                    $data['password_confirmation'] = self::PASS_PLACEHOLDER;

                    return $data;
                })
                ->mutateFormDataUsing(function (array $data) {
                    if (array_key_exists('password', $data) && $data['password'] === self::PASS_PLACEHOLDER) {
                        unset($data['password']);
                    }

                    return $data;
                }),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    /** @return array<string,array<int,mixed>> */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }

    protected static function getNavigationGroup(): string|null
    {
        return __('Administration');
    }
}
