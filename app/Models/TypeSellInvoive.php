<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSellInvoive extends Model
{
    use HasFactory;

    protected $table = 'type_sell_invoives';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'commodity_type_id', 'sell_quantity', 'selling_price', 'total_cost', 'payment', 'change', 'owner_id', 'customer_id'];
    protected $visible = ['commodity_id', 'commodity_type_id', 'sell_quantity', 'selling_price', 'total_cost', 'payment', 'change', 'owner_id', 'customer_id'];

    // A commodity type can be included in many purchase or sell invoices
    public function CommodityType()
    {
        return $this->hasMany(
            CommodityType::class,
            'commodity_type_id',
        );
    }
}
