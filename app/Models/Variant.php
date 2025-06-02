<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    public string $size;

    public string $color;
    
    /**
     * The table associated with the model.
     */
    protected $table = 'variants';

    protected $fillable = ['product_id', 'config', 'price'];

    protected $casts = [
        'config' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function stock() {
        return $this->belongsTo(Stock::class, 'id', 'variant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function setConfig(array $config) : void {
        $this->config = Json::encode($config);
    }

    public function config_decode($key = null) {

        $config = Json::decode($this->config);

        return $key !== null ? $config[$key] : $config;
    }

    public function fmt_price()
    {
        $value = number_format($this->price, 2, ',', '.'); 
        return "R$ {$value}";
    }

    public function fmt_color() {
        return (
            match($this->config_decode('color')) {
                'red'   => 'Vermelho',
                'green' => 'Verde',
                'blue'  => 'Azul',
            }      
        );
    }

    public function toArray() : array
    {
        return [
            'id'         => $this->id,
            'product_id' => $this->product_id,
            'price'      => $this->price,
            'size'       => $this->config_decode('size'),
            'color'      => $this->fmt_color(),
            'stock'      => $this->stock->quantity,
            
            'format'     => [
                'price'  => $this->fmt_price()
            ]
        ];
    }

    public function __toString() : string {
        [$size, $color] = [$this->config_decode('size'), $this->fmt_color()];
        return "{$size} - {$color}";
    }
}
