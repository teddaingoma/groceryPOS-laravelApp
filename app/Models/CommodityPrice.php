<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommodityPrice extends Model
{
    use HasFactory;

    protected $table = 'commodity_prices';

    protected $primary = 'commodity_id';

    protected $timestamp = true;

    protected $fillable = ['commodity_id', 'price'];

    protected $visible = ['commodity_id', 'price'];

    //A Single Price is assigned to a single commodity
    public function CommodityPrice()
    {
        return $this->belongsTo(
            Commodity::class
        );
    }
}
