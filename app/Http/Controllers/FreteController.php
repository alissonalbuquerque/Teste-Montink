<?php

namespace App\Http\Controllers;

use App\Models\Frete;
use Illuminate\Http\Request;

use NumberFormatter;

class FreteController extends Controller
{
    public function calculate(Request $request)
    {
        $buy_price = $request->get('price', 0.00);

        $frete = new Frete($buy_price);

        $price = $frete->calculate();

        return [
            'frete'     => $price,
            'fmt_frete' => (new \NumberFormatter('pt_BR', NumberFormatter::CURRENCY))->formatCurrency($price, 'BRL'),
        ];
    }
}
