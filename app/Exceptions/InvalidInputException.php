<?php

namespace App\Exceptions;

use Exception;

class InvalidInputException extends Exception
{


  private $body;


  public function __construct($body, $code = 400, Exception $previous = null) {
    $this->body = $body;
    parent::__construct(null, $code, $previous);
  }


  public function getBody() {
    return $this->body;
  }


  /**
   * Report the exception.
   *
   * @return void
   */
  public function report()
  {
    //
  }


  /**
   * Render the exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function render($request)
  {
    return response()->json([
      'err' => $this->body
    ], $this->code < 400 ? 400 : $this->code);
  }
}
