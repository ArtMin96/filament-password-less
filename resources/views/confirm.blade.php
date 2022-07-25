<form wire:submit.prevent="authenticate" class="space-y-8">
    @if(session()->has('success'))
        <div class="p-4 mb-4 text-sm text-success-700 bg-success-500/10 rounded-lg dark:bg-success-900/50 dark:text-success-700" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{ $this->form }}

    <x-filament::button type="submit" form="authenticate" class="w-full">
        {{ __('filament-password-less::filament-password-less.confirm.buttons.confirm.label') }}
    </x-filament::button>

    @if(session()->has('passphrase'))
        <div class="text-center">
            {{ __('filament-password-less::filament-password-less.confirm.buttons.resend.help_text') }}
            <a x-data @click="$wire.resentPassPhrase()" href="#" class="text-primary-600 hover:text-primary-700">
                {{ __('filament-password-less::filament-password-less.confirm.buttons.resend.label') }}
            </a>
        </div>
    @endif

    <div class="text-center">
        <a href="{{ route('filament.auth.login') }}" class="text-primary-600 hover:text-primary-700">
            {{ __('filament-password-less::filament-password-less.confirm.buttons.sign_in.label') }}
        </a>
    </div>
</form>
