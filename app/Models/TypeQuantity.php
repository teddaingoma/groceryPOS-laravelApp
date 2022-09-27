<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeQuantity extends Model
{
    use HasFactory;

    protected $table = 'type_quantities';
    protected $primary = 'id';
    protected $timestamp = true;
    protected $fillable = ['type_quantity', 'commodity_type_id'];
    protected $visible = ['type_quantity', 'commodity_type_id'];

    // An amount of quantity is associated to a single Type
    public function Type()
    {
        return $this->belongsTo(
            CommodityType::class
        );
    }
}
