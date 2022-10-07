<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCostPrice extends Model
{
    use HasFactory;

    protected $table = 'type_cost_prices';
    protected $primary = 'id';
    protected $timestamp = true;
    protected $fillable = ['type_cost_price', 'commodity_type_id'];
    protected $visible = ['type_cost_price', 'commodity_type_id'];

    // A single unit cost price is linked to a single Type
    public function Type()
    {
        return $this->belongsTo(
            CommodityType::class
        );
    }
}
