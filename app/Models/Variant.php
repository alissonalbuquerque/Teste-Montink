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

    public function setConfig(array $config) : void {
        $this->config = Json::encode(['size'  => 'P', 'color' => 'red']);
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
}
