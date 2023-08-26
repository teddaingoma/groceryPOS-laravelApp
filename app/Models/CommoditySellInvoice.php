<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommoditySellInvoice extends Model
{
    use HasFactory;

    protected $table = 'commodity_sell_invoices';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'sell_quantity', 'selling_price', 'total_cost', 'payment', 'change', 'user_id', 'customer_id'];
    protected $visible = ['commodity_id', 'sell_quantity', 'selling_price', 'total_cost', 'payment', 'change', 'user_id', 'customer_id'];

    // A commodity can be included in many sell invoices
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id',
        );
    }

    // A customer can be included in a sell invoice
    public function Customer()
    {
        return $this->belongsTo(
            Customer::class,
            'customer_id',
        );
    }
}
