<?php

namespace ArtMin96\FilamentPasswordLess\Http\Livewire\Auth;

use ArtMin96\FilamentPasswordLess\Events\PassPhraseSent;
use ArtMin96\FilamentPasswordLess\FilamentPasswordLess;
use Filament\Facades\Filament;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class Confirm extends Component implements HasForms
{
    use InteractsWithForms;

    public $passPhrase = '';

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        if (! Session::has('email')) {
            redirect()->route('filament.auth.login');
        }

        $this->form->fill();
    }

    public function authenticate()
    {
        $data = $this->form->getState();

        if (Session::get('passphrase_expiry') < now()->timestamp) {
            if (Filament::auth()->check()) {
                Filament::auth()->logout();
            }

            $this->clearSession(request());
            Session::flash('danger', __('filament-password-less::validation.expired_passphrase'));

            return redirect()->route('filament.auth.login');
        }

        $this->hasValidPassPhrase($data['passPhrase']);

        $user = app(FilamentPasswordLess::class)->getUser();

        Filament::auth()->login($user);

        $this->clearSession(request());

        return app(LoginResponse::class);
    }

    public function resentPassPhrase()
    {
        $user = app(FilamentPasswordLess::class)->getUser();

        event(new PassPhraseSent($user));

        Session::flash('success', __('filament-password-less::filament-password-less.confirm.messages.passphrase_resent'));
    }

    public function hasValidPassPhrase(string $passPhrase)
    {
        if (strtolower($passPhrase) != Session::get('passphrase')) {
            throw ValidationException::withMessages([
                'passPhrase' => [__('filament-password-less::validation.wrong_passphrase')],
            ]);
        }
    }

    private function clearSession($request)
    {
        $request->session()->forget('passphrase');
        $request->session()->forget('passphrase_expiry');
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('passPhrase')
                ->label(__('filament-password-less::filament-password-less.confirm.fields.passphrase.label'))
                ->required(),
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('filament-password-less::confirm')
            ->layout('filament::components.layouts.card', [
                'title' => __('filament::login.title'),
            ]);
    }
}
