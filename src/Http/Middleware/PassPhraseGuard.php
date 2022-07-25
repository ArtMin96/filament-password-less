<?php

namespace ArtMin96\FilamentPasswordLess\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PassPhraseGuard
{
    /**
     * Handle an incoming request.
     *
     * if the user's session contains a passphrase then we need to direct the user to the
     * passphrase confirm route instead.
     * need to allow the user through to any login routes
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $passphrase = $request->session()->get('passphrase');

        if (is_null($passphrase)) {
            return $next($request);
        }

        // passphrase set, still valid?
        if ($request->session()->get('passphrase_expiry') < now()->timestamp) {
            $request->session()->forget('passphrase');
            $request->session()->forget('passphrase_expiry');

            Filament::auth()->logout();

            return redirect('/');
        }

        if ($request->route()->named('filament.auth.login.*')) {
            return $next($request);
        }

        return redirect()->route('filament.auth.login.confirm');
    }
}
