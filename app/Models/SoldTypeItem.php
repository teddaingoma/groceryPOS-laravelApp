<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldTypeItem extends Model
{
    use HasFactory;

    protected $table = 'sold_type_items';
    protected $primary = 'id';
    public $timestamps = true;
    protected $fillable = ['commodity_id', 'commodity_type_id', 'sold_quantity','selling_price', 'user_id'];
    protected $visible = ['commodity_id', 'commodity_type_id', 'sold_quantity','selling_price', 'user_id'];

    // A commodity Type has a sells with many counts
    public function SoldType()
    {
        return $this->belongsTo(
            CommodityTType::class,
            'commodity_type_id',
        );
    }
}
