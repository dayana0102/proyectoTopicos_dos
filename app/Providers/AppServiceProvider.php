<?php

namespace App\Providers;

use App\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningUnitTests()) {
            Schema::defaultStringLength(191);
        }
        VerifyEmail::$toMailCallback = function ($notifiable, $verificationUrl){
            return (new MailMessage)
            ->subject(Lang::get('Verificación de su cuenta'))
            ->line(Lang::get('Haga clic en el botón para verificar su dirección de correo electrónico.'))
            ->action(Lang::get('Confirmar correo electrónico'), $verificationUrl)
            ->line(Lang::get('Si no creó una cuenta, no se requiere ninguna otra acción.'));
        };
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing') && class_exists(DuskServiceProvider::class)) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
