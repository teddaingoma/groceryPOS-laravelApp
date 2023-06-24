<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePurchase extends Model
{
    use HasFactory;

    protected $table = 'type_purchases';
    protected $primary = 'id';
    public $timestamps = true;
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'commodity_type_id', 'quantity', 'cost_price', 'user_id'];
    protected $visible = ['commodity_id', 'commodity_type_id', 'quantity', 'cost_price', 'user_id'];

    // A commodity type has many purchase counts
    public function CommodityType()
    {
        return $this->belongsTo(
            CommodityType::class,
            'commodity_type_id'
        );
    }
}
