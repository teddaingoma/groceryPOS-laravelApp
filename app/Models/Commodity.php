<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commodity extends Model
{
    use HasFactory;

    protected $table = 'commodities';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'description', 'image_path'];

    protected $visible = ['id', 'name', 'description'];

    //protected $dateFormat = 'h:m:s';

    // One or more commodities belongs to one or many categories
    public function Categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Only one Commodity has one or many types: hasMany relationship
    public function Types()
    {
        return $this->hasMany(CommodityType::class);
    }

    //Has one Price
    public function Price()
    {
        return $this->hasOne(
            CommodityPrice::class
        );
    }

    //Has a single quantity amount
    public function Quantity()
    {
        return $this->hasOne(
            CommodityQuantity::class
        );
    }

    //Has a single unit of measurement
    public function Unit()
    {
        return $this->hasOne(
            CommodityUnit::class
        );
    }

    //Has a single date of acquisition
    public function AquisitionDate()
    {
        return $this->hasOne(
            CommodityAquisitionDate::class
        );
    }


}
