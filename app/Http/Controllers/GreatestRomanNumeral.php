<?php

namespace App\Http\Controllers;

use App\Http\Service\HandleArrayService;
use Illuminate\Http\Request;

class GreatestRomanNumeral extends Controller
{
    public function showRomanNumber(Request $request)
    {
        $handleArray = new HandleArrayService();
        $result = $handleArray->handleArray($request->json()->all());
        return json_encode($result);
    }
}
