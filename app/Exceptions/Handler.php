<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        $exception = $this->prepareException($exception);

        if (
            (getenv('APP_ENV') == 'local' || isset($_GET['test-error'])) &&
            !$exception instanceof ApiNotAvailableException
        ) {

            $toEmails = array(
                'mra@narola.email',
            );

            if ( $exception instanceof AuthenticationException ) {
                return $this->unauthenticated($request, $exception);
            } else if ( $exception instanceof ValidationException ) {
                return $this->convertValidationExceptionToResponse($exception,$request);
            } else {

                if ( !$exception instanceof NotFoundHttpException ){

                    if ( !strstr( $exception->getMessage(), 'toObject()') ) {
                        $name = 'Guest User';
                        $email = 'guest@gmail.com';
                        
                        if ( auth()->check() ) {
                            $name =  auth()->user()->name_first;
                            $email = auth()->user()->email;
                        }

                        $content['error_message'] = $exception->getMessage();
                        $content['error_code'] = $exception->getCode();
                        $content['filename'] = $exception->getFile();
                        $content['url'] = \Request::fullUrl();
                        $content['error_line'] = $exception->getLine();
                        $content['user_name'] = $name;
                        $content['user_email'] = $email; 
                        \Mail::send('emails.exception', compact('content'), function ($message) use ($toEmails) {
                            $message->to($toEmails)
                                ->subject('[Error] Some error happened at the development|production <PROJECT NAME>');
                        });
                    }
                } else {
                    return response()->view('errors.404');
                }

                return response()->view('errors.500');
            }
        }

        if ( $exception instanceof ApiNotAvailableException ) {
            return response()->json(['error' => [$exception->getMessage()]], 500);
        }


        if ( $exception instanceof NotFoundHttpException ) {
            return response()->view('errors.404');
        }

        return parent::render($request, $exception);
    }
}
