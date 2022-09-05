<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityUnit extends Model
{
    use HasFactory;

    protected $table = 'commodity_units';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['commodity_id', 'unit'];

    protected $visible = ['commodity_id', 'unit'];
}
