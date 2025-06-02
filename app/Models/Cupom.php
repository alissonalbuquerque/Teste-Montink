<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cupom extends Model
{
    use HasFactory, SoftDeletes;
    
    /**
     * The table associated with the model.
     */
    protected $table = 'coupons';

    protected $fillable = ['code', 'start_date', 'end_date', 'minimal_value', 'percentage', 'active'];

    public function fmt_start_date() : string {
        return Carbon::parse($this->start_date)->format('d/m/Y');
    }

    public function fmt_end_date() : string {
        return Carbon::parse($this->end_date)->format('d/m/Y');
    }

    public function fmt_minimal_value() : string {
        return "R$ " . number_format($this->minimal_value, 2, ',', '.');
    }

    public function fmt_percentage() : string {
        return "{$this->percentage}%";
    }

    public function fmt_active() : string {
        return $this->active ? 'Sim' : 'Não';
    }

    public function discount(float $value) {
        return $value >= $this->minimal_value ? ($value * ($this->percentage / 100.00)) : 0.00;
    }
}
