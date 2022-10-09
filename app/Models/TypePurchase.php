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
    protected $fillable = ['commodity_id', 'type_id', 'quantity', 'cost_price'];
    protected $visible = ['commodity_id', 'type_id', 'quantity', 'cost_price'];

    // A commodity type has many purchase counts
    public function CommodityType()
    {
        return $this->belongsTo(
            CommodityType::class,
            'type_id'
        );
    }
}
