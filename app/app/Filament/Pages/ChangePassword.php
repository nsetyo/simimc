<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Components\ViewComponent;

/**
 * @property ComponentContainer $form
 */
class ChangePassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public string|null $password = null;
    public string|null $new_password = null;
    public string|null $new_password_confirmation = null;

    protected static string|null $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.change-password';

    public function submit(): void
    {
        $data = $this->form->getState();

        $new_password = $data['new_password'];

        $user = auth()->user();

        $user?->forceFill(['password' => $new_password])->save();

        Notification::make()
            ->title(__('Password saved successfully'))
            ->success()
            ->send();

        $this->form->fill([
            'password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        ]);
    }

    /** @return array<string,mixed> */
    protected function getViewData(): array
    {
        return [];
    }

    /** @return ViewComponent[] */
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->rules(['current_password'])
                    ->label('Password saat ini')
                    ->required(),
                Forms\Components\TextInput::make('new_password')
                    ->confirmed()
                    ->password()
                    ->label('Password baru')
                    ->required(),
                Forms\Components\TextInput::make('new_password_confirmation')
                    ->password()
                    ->dehydrated(false)
                    ->label('Konfirmasi password baru')
                    ->required(),
            ]),
        ];
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
