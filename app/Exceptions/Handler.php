<?php

namespace App\Exceptions;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->renderable(function (HttpException $exception, $request) {
        //     if ($request->is('v1/*')) {
        //         return redirect(route('errors'))->with('error', $exception->getstatusCode() . ' | ' . $exception->getMessage());
        //     } else {
        //         return redirect(route('errors'))->with('error', $exception->getstatusCode() . ' | ' . $exception->getMessage());
        //     }
        // });

        // $this->renderable(function (RequestException $exception) {
        //     $response = $exception->getResponse();
        //     $rbody = $response->getReasonPhrase();
        //     $rcode = $exception->getCode();
        //     return redirect(route('errors'))->with('error', $rcode . ' | ' . $rbody);
        // });
    }
}
