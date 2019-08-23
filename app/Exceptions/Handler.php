<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
     public function render($request, Exception $exception)
     {

       // Changed default error handler for better experience
       if($exception instanceof \App\Exceptions\InvalidInputException) {
         return $exception->render($request);
       }
       elseif($exception instanceof \Illuminate\Validation\ValidationException) {
         $errors = $exception->errors();

         foreach ($errors as $i => $err) {
           $errors[$i] = $err[0];
         }

         return response()->json([
           'err' => $errors,
         ], 400);
       }
       else {
         // if(array_search(env('APP_ENV'), [ 'local', 'dev', 'test' ]) !== FALSE) {
           return parent::render($request, $exception);
         // } else {
         //   return response()->json([
         //     'err' => 'Server error, try later'
         //   ], 500);
         // }
       }

     }
}
