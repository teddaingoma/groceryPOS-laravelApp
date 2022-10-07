<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityCostPrice extends Model
{
    use HasFactory;

    protected $table = 'commodity_cost_prices';
    protected $primary = 'id';
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'cost_price'];
    protected $visible = ['commodity_id', 'cost_price'];

    //A Single cost Price is assigned to a single commodity
    public function CommodityCostPrice()
    {
        return $this->belongsTo(
            Commodity::class
        );
    }

}
