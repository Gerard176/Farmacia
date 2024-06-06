<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class NotFoundHttpException extends Exception
{

    // public function __construct($message = 'Error personalizado', $code = 0, Exception $previous = null) 
    // {
    //     parent::__construct($message, $code, $previous);
    // }  
    
    public function report()    
    {         
    
    } 

    public function render(Request $request)
    {
        return response()->view('errors.404',[],404);
     
    } 
}
