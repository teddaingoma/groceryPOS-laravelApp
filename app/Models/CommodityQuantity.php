<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityQuantity extends Model
{
    use HasFactory;

    protected $table = 'commodity_quantities';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['commodity_id', 'quantity'];

    protected $visible = ['commodity_id', 'quantity'];

    //Belongs to a single commodity
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class
        );
    }
}
