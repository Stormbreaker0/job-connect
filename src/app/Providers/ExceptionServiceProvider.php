<?php
// filepath: /opt/job-linker/src/app/Providers/ExceptionServiceProvider.php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;

class ExceptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ExceptionHandlerContract::class, Handler::class);
    }
}