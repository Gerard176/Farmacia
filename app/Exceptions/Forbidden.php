<?php

namespace App\Exceptions;
use Illuminate\Http\Request;
use Exception;

class Forbidden extends Exception
{
    public function render(Request $request)
    {
        return response()->view('errors.403',[],403);
     
    } 
}
