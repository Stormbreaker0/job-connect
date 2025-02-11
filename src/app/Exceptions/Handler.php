<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        // Logica di reporting personalizzata
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // Personalizzazione della risposta dell'errore
        return parent::render($request, $exception);
    }
}