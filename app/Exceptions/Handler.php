<?php

namespace App\Exceptions;
use App\Exceptions\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as ExceptionNotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'name',
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) { 
            return $e->render($request);
        });

        $this->renderable(function (Forbidden $e, $request) {
            return $e->render($request);
        });
        $this->renderable(function (InternalServerError $e, $request) {
            return $e->render($request);
        });
        $this->renderable(function (AuthenticationTimeout $e, $request) {
            return $e->render($request);
        });
        // $this->reportable(function (Throwable $e) {
            
        // });
    }
    

    // Otros métodos del manejador de excepciones...

    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof NotFoundHttpException) {
    //         return $exception->render($request);
    //     }

    //     return parent::render($request, $exception);
    // }

}
