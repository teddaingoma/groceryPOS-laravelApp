<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityType extends Model
{
    use HasFactory;

    protected $table = "commodity_types";
    protected $primary = "id";
    protected $fillable = ["commodity_id", "type_name", "description", "image_path"];
    protected $visible = ["commodity_id", "type_name", "description", "image_path"];
    protected $timestamp = true;

    // One or Many Types belong to only one Commodity: belengsTo
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class,
        );
    }

    // One type has is linked to a single price
    public function TypePrice()
    {
        return $this->hasOne(
            TypePrice::class
        );
    }

    // One type has a single amount of available quantity
    public function TypeQuantity()
    {
        return $this->hasOne(
            TypeQuantity::class
        );
    }

    // One type has a single date of acquisition
    public function TypeAquisitionDate()
    {
        return $this->hasOne(
            TypeAquisitionDate::class
        );
    }
}
