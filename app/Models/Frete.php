<?php

namespace App\Models;

class Frete
{   
    private float $buy_price;

    private float $frete_price;

    public function __construct(float $buy_price) {
        $this->buy_price = $buy_price;
    }

    public function calculate() {

        $price = $this->buy_price;

        if($price >= 52.00 && $price <= 166.59 )
        {
            $this->frete_price = 15.00;
        } elseif($price > 200.00)
        {
            $this->frete_price = 0.00;
        } elseif($price >= 166.60 && $price <= 200)
        {
            $this->frete_price = 20.00;    
        } else
        {
            $this->frete_price = 20.00;
        }

        return $this->frete_price;
    }   
}
