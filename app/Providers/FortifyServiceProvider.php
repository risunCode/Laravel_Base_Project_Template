<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Fortify::ignoreRoutes();
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->login)
                ->orWhere('username', $request->login)
                ->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return null;
            }

            if ($user->isBanned()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'login' => [__('Your account has been banned. Please contact support.')],
                ]);
            }

            if ($user->isFrozen()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'login' => [__('Your account has been frozen. Please contact support.')],
                ]);
            }

            return $user;
        });

        Fortify::loginView(fn () => view('pages.auth.login'));
        Fortify::registerView(fn () => view('pages.auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('pages.auth.forgot-password'));
        Fortify::resetPasswordView(fn ($request) => view('pages.auth.reset-password', ['request' => $request]));
    }
}
