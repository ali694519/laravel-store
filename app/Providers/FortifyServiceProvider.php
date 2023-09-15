<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $request = request();
        if($request->is('admin/*')) {
            // Config::set('fortify.guard','admin');
            // Config::set('fortify.passwords','admins');
            // Config::set('fortify.prefix','admin');
            // Config::set('fortify.home','admin/dashboard');
            // Config::set('fortify.home','admin/dashboard');
            config(['fortify.guard' => 'admin']);
            config(['fortify.passwords' => 'admins']);
            config(['fortify.prefix' => 'admin']);
            config(['fortify.home' => 'admin/dashboard']);

        }

        // $this->app->instance(LoginResponse::class,new class implements LoginResponse{
        //     public function toResponse($request)
        //     {
        //         if($request->user('admin')) {
        //         return redirect('/');
        //         }
        //     }
        // });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);



        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        if (Config::get('fortify.guard') == 'admin') {
            Fortify::authenticateUsing([new AuthenticateUser, 'authenticate']);
            Fortify::viewPrefix('auth.');
        } else {
            Fortify::viewPrefix('front.auth.');
        }

        // Fortify::loginView(function() {
        //     if(Config::get('fortify.guar') == 'web') {
        //         return view('front.auth.login');
        //     }
        //     return view('auth.login');
        // });


        // Fortify::registerView(function() {
        //     return view('auth.register');
        // });
    }
}
