<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityBudgetedSale extends Model
{
    use HasFactory;

    protected $table = 'commodity_budgeted_sales';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    public $fillable = ['commodity_id', 'quantity', 'selling_price', 'sales_date'];
    protected $visible = ['commodity_id', 'quantity', 'selling_price', 'sales_date'];

    //A commodity can be sold once or many times
    public function CommodityBudgetedSale()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id'
        );
    }
}
