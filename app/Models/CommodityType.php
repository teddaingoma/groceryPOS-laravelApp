<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityType extends Model
{
    use HasFactory;

    protected $table = "commodity_types";
    protected $primary = "id";
    protected $fillable = ["commodity_id", "type_name"];
    protected $visible = ["commodity_id", "type_name"];
    protected $timestamp = true;

    // One or Many Types belong to only one Commodity: belengsTo
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class,
            'commodity_id',
        );
    }
}
