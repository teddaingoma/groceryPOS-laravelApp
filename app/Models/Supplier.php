<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image_path',
    ];

    /**
     * The attributes that should be visible for serialization.
     *
     * @var array<int, string>
     */
    protected $visible = [
        'name',
        'email',
        'image_path',
    ];

    protected $table = 'suppliers';
    protected $primary = 'id';
    protected $timestamp = true;

    /**
     * a supplier is included in purchase transactions of commodities or types
     */
    public function commodityPurchaseInvoices()
    {
        return $this->hasMany(
            CommodityPurchaseInvoice::class,
            'supplier_id'
        );
    }
    public function typePurchaseInvoices()
    {
        return $this->hasMany(
            TypePurchaseInvoice::class,
            'supplier_id'
        );
    }
}
