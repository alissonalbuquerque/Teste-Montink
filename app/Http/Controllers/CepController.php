<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CepController extends Controller
{
    public function search(string $cep)
    {
        return $cep;
    }
}
