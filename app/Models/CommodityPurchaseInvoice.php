<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityPurchaseInvoice extends Model
{
    use HasFactory;

    protected $table = 'commodity_purchase_invoices';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'quantity', 'cost_price', 'selling_price', 'user_id', 'supplier_id'];
    protected $visible = ['commodity_id', 'quantity', 'cost_price', 'selling_price', 'user_id', 'supplier_id'];

    // a purchase invoice is associated with a commodity
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id',
        );
    }

    //a purchase invoice is carried out by a user
    public function User()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
        );
    }
}
