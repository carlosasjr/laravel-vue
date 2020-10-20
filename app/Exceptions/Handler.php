<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Requisição não encontrada',
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getStatusCode()
                    ]
                ], 404);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Verbo inválido para esta rota',
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getStatusCode()
                    ]
                ], 404);
            }
        });


        $this->renderable(function (TokenExpiredException $e, $request) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Token Expirado',
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getStatusCode()
                    ]
                ], 404);
            }
        });

        $this->renderable(function (TokenInvalidException $e, $request) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Token Inválido',
                    'error' => [
                        'message' => $e->getMessage(),
                        'code' => $e->getStatusCode()
                    ]
                ], 404);
            }
        });

    }
}
