<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use NumberFormatter;

class Order extends Model
{
    // use SoftDeletes;
    
    /**
     * The table associated with the model.
     */
    protected $table = 'orders';

    protected $fillable = ['email', 'cupom_id', 'buy', 'frete', 'cupom', 'subtotal', 'status', 'payment_method'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<TRelatedModel, $this> 
     */
    public function order_items() {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<TRelatedModel, $this>
     */
    public function cupom_model() {
        return $this->belongsTo(Cupom::class, 'cupom_id', 'id');
    }

    public static function formatter($value) : string {
        return (new \NumberFormatter('pt_BR', NumberFormatter::CURRENCY))->formatCurrency($value, 'BRL');
    }

    public function fmt_buy() : string {
        return $this->formatter($this->buy);
    }

    public function fmt_frete() : string {
        return $this->formatter($this->frete);
    }

    public function fmt_cupom() : string {
        return $this->formatter($this->cupom);
    }

    public function fmt_subtotal() : string {
        return $this->formatter($this->subtotal);
    }

    public function status_text() : string {
        return (
            match($this->status) {
                'pending'  => 'Pendente',
                'finished' => 'Concluído',
                default    => 'NaN'
            }      
        );
    }

    public function payment_method_text() : string {
        return (
            match($this->payment_method) {
                'card' => 'Cartão',
                default   => 'NaN'
            }      
        );
    }
}
