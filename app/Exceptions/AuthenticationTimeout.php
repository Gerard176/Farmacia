<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class AuthenticationTimeout extends Exception
{
    public function render(Request $request)
    {
        return response()->view('errors.419',[],419);
     
    } 
}
