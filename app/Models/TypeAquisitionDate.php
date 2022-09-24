<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAquisitionDate extends Model
{
    use HasFactory;

    protected $table = 'type_aquisition_dates';
    protected $primary = 'id';
    protected $timestamp = true;
    protected $fillable = ['type_aquisition_date', 'commodity_type_id'];
    protected $visible = ['type_aquisition_date', 'commodity_type_id'];

    // A date of acquisition is linked to a single type
    public function Type()
    {
        return $this->belongsTo(
            CommodityType::class
        );
    }
}
