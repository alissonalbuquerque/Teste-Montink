<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class OrderItem extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'order_items';

    protected $fillable = ['order_id', 'variant_id', 'product_id', 'unit_price', 'quantity', 'total_price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function variant() {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function formatter($value) : string {
        return (new \NumberFormatter('pt_BR', NumberFormatter::CURRENCY))->formatCurrency($value, 'BRL');
    }

    public function fmt_unit_price() : string {
        return $this->formatter($this->unit_price);
    }

    public function fmt_quantity() : string {
        return $this->quantity;
    }

    public function fmt_total_price() : string {
        return $this->formatter($this->total_price);
    }
}
