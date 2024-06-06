<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Exception;

class InternalServerError extends Exception
{
    public function render(Request $request)
    {
        return response()->view('errors.500',[],500);
     
    } 
}
