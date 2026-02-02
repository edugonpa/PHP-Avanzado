<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;;

class ApiExampleController extends Controller
{
    public function index()
    {
        return view('api-examples.index');
    }

    public function getUser()
    {
        try {
            //Realizar una peticion GET
            $response = Http::get(config('services.jsonplaceholder.url') . '/users');

            //Verificar si la peticion fue existosa
            if ($response->successful()) {
                $users = $response->json();

                return $users;
            }

            //Si no fue exitosa manejar el error
            return "la peticion al servicio no fue exitosa";
        } 
        catch (Exception $e) {
            Log::error('Error en getUsers: ' . $e->getMessage());
            return "la peticion al servicio no fue exitosa";
        }

    }
}
