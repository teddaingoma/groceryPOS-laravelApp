<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldCommodityItem extends Model
{
    use HasFactory;

    protected $table = 'sold_commodity_items';
    protected $primary = 'id';
    public $timestamps = true;
    protected $fillable = ['commodity_id', 'sold_quantity','selling_price', 'user_id'];
    protected $visible = ['commodity_id', 'sold_quantity','selling_price', 'user_id'];

    //A commodity item can be sold once or many times
    public function SoldCommodity()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id'
        );
    }
}
