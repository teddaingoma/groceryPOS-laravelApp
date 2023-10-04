<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
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

    protected $table = 'customers';
    protected $primary = 'id';
    protected $timestamp = true;

    /**
     * a customer is included in a sell transactions of commodities or types
     */
    public function commoditySellInvoices()
    {
        return $this->hasMany(
            CommoditySellInvoice::class,
            'customer_id'
        );
    }
    public function typeSellInvoices()
    {
        return $this->hasMany(
            TypeSellInvoive::class,
            'customer_id',
        );
    }
}
