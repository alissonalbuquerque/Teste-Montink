<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{   
    use HasFactory, SoftDeletes;
    
    /**
     * The table associated with the model.
     */
    protected $table = 'products';

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<TRelatedModel, $this> 
     */
    public function variants() {
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }

    public function qtd_variants() : int {
        return $this->variants->count();
    }

    public static function sizes() : array {
        return [
            
        ];
    }
}
