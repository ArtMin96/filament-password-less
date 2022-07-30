<?php

namespace ArtMin96\FilamentPasswordLess\Http\Livewire\Auth;

use ArtMin96\FilamentPasswordLess\Events\PassPhraseSent;
use ArtMin96\FilamentPasswordLess\FilamentPasswordLess;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class Login extends Component implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public $email = '';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }

    public function authenticate()
    {
        $this->doRateLimit();

        $data = $this->form->getState();

        Session::put('email', $data['email']);

        $user = app(FilamentPasswordLess::class)->getUser();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.failed'),
            ]);
        }

        event(new PassPhraseSent($user));

        if (app(FilamentPasswordLess::class)->usesMagicLink()) {
            Session::flash('success', __('filament-password-less::filament-password-less.login.messages.magic_link_sent'));
            Session::forget('email');
        } else {
            Session::flash('success', __('filament-password-less::filament-password-less.login.messages.passphrase_sent'));
        }

        return redirect()->route('filament.auth.login.confirm');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label(__('filament-password-less::filament-password-less.login.fields.email.label'))
                ->email()
                ->required()
                ->autocomplete(),
        ];
    }

    private function doRateLimit()
    {
        try {
            $this->rateLimit(config('filament-password-less.rate_limit_count'));
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.throttled', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('filament-password-less::login')
            ->layout('filament::components.layouts.card', [
                'title' => __('filament::login.title'),
            ]);
    }
}
