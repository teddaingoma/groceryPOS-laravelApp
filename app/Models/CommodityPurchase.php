<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityPurchase extends Model
{
    use HasFactory;

    protected $table = 'commodity_purchases';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'quantity', 'cost_price', 'purchace_date'];
    protected $visible = ['commodity_id', 'quantity', 'cost_price', 'purchace_date'];

    //A commodity can be purchased (acquired, bought, or increased) once or many times
    public function CommodityPurchase()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id'
        );
    }
}
