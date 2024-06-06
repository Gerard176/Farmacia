<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    public function mostrarNombre()
    {
        $usuario = User::first(); // Obtiene el primer usuario de la base de datos
        $nombre = $usuario->name; // Accede al valor del campo "name" del usuario
        return view('sidebar',['nombre' => $nombre]);
    }
    use AuthorizesRequests, ValidatesRequests;
}

