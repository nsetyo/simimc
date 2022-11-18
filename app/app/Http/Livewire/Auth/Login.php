<?php

declare(strict_types=1);

namespace App\Http\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Contracts\HasForms;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use WithRateLimiting;

    public bool $remember = false;

    public string|null $nrp = '';

    public string|null $password = '';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function authenticate(): LoginResponse|null
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->throw(__('filament::login.messages.throttled', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));
        }

        $data = $this->form->getState();

        if (!Filament::auth()->attempt($this->getCredentials($data), $data['remember'])) {
            $this->throw(__('filament::login.messages.failed'));
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    public function render(): View
    {
        $view = view('filament::login');

        $layout = [$view, 'layout'];

        $layoutArgs = ['filament::components.layouts.card', ['title' => __('filament::login.title')]];

        return call_user_func_array($layout, $layoutArgs);
    }

    /** @return array<int,Forms\Components\Component> */
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('nrp')
                ->label('NRP')
                ->required()
                ->autocomplete(),
            Forms\Components\TextInput::make('password')
                ->label(__('filament::login.fields.password.label'))
                ->password()
                ->required(),
            Forms\Components\Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label')),
        ];
    }

    /**
     * @param array<string,string> $data
     *
     * @return array<string,string>
     */
    private function getCredentials(array $data): array
    {
        return Arr::only($data, ['nrp', 'password']);
    }

    /** @param string|string[]|null $message */
    private function throw(string|array|null $message): never
    {
        throw ValidationException::withMessages(['nrp' => $message]);
    }
}
