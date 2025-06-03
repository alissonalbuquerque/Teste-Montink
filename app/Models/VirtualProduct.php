<?php

namespace App\Models;

use Illuminate\Support\Collection;

class VirtualProduct
{   
    public ?Variant $variant;

    public ?Product $product;

    public ?string $name;

    public ?float $price;

    public ?int $units;

    public ?string $subtotal;

    public ?string $variation;

    public ?string $fmt_price;

    public ?string $fmt_subtotal;

    public ?string $fmt_variation;

    public function __construct(?array $data)
    {   
        if(is_array($data))
        {
            $this->variant       = Variant::findOrFail($data['variant_id']);
            $this->product       = $this->variant->product;
            $this->name          = $this->variant->product->name;
            $this->price         = $this->variant->price;
            $this->units         = $data['units'];
            $this->variation     = "({$this->variant})";
            $this->subtotal      = $this->price * $this->units;
            $this->fmt_price     = 'R$ ' . number_format($this->price, 2, ',', '.');
            $this->fmt_subtotal  = 'R$ ' . number_format($this->subtotal, 2, ',', '.');
            $this->fmt_variation =  "{$this->name} : {$this->variation}";
        }

        if(is_null($data)) {
            $this->name          = null;
            $this->price         = null;
            $this->units         = null;
            $this->subtotal      = null;
            $this->variation     = null;
            $this->fmt_price     = null;
            $this->fmt_subtotal  = null;
            $this->fmt_variation = null;
        }
    }

    public function toArray() : array
    {
        return [
            'name'         => $this->name,
            'price'        => $this->price,
            'units'        => $this->units,
            'variation'    => $this->variation,
            'subtotal'     => $this->subtotal,
            'fmt_price'    => $this->fmt_price,
            'fmt_subtotal' => $this->fmt_subtotal,
        ];
    }

    public static function create(array $data) : self {
        return new self($data);
    }

    public static function vProductReduced(Collection $collection) : self {

        $subtotal = $collection->reduce(fn(?float $carry, self $vproduct) => $carry + $vproduct->subtotal);

        $vproduct = new self(null);
        $vproduct->subtotal     = $subtotal;
        $vproduct->fmt_subtotal = 'R$ ' . number_format($vproduct->subtotal, 2, ',', '.');

        return $vproduct;
    }
}
