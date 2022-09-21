<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityAquisitionDate extends Model
{
    use HasFactory;

    protected $table = 'commodity_aquisition_dates';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['commodity_id', 'aquisition_date'];

    protected $visible = ['commodity_id', 'aquisition_date'];

    //An acquisition Date belongs to a single commodity
    public function Commodity()
    {
        return $this->belongsTo(
            Commodity::class
        );
    }
}
