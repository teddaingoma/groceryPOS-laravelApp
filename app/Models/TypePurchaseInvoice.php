<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePurchaseInvoice extends Model
{
    use HasFactory;

    protected $table = 'type_purchase_invoices';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'commodity_type_id','quantity', 'cost_price', 'selling_price', 'user_id', 'supplier_id'];
    protected $visible = ['commodity_id', 'commodity_type_id','quantity', 'cost_price', 'selling_price', 'user_id', 'supplier_id'];

    // a purchase invoice is associated with a commodity type
    public function CommodityType()
    {
        return $this->belongsTo(
            CommodityType::class,
            'commodity_type_id',
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

    // a supplier is involved in a purchase invoice
    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'supplier_id',
        );
    }
}
