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

    protected $visible = ['id', 'name', 'description', 'image_path'];

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

    //Has one Selling Price
    public function Price()
    {
        return $this->hasOne(
            CommodityPrice::class
        );
    }

    //Has one Cost Price
    public function CostPrice()
    {
        return $this->hasOne(
            CommodityCostPrice::class
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

    //A commodity can be purchased (acquired, bought, or increased) once or many times
    public function CommodityPurchases()
    {
        return $this->hasOne(
            CommodityPurchase::class
        );
    }

    //A commodity can be (budgeted to be) sold once or many times
    public function CommodityBudgetedSales()
    {
        return $this->hasOne(
            CommodityBudgetedSale::class
        );
    }

    //A commodity item can be sold once or many times
    public function SoldCommodityItem()
    {
        return $this->hasOne(
            SoldCommodityItem::class
        );
    }

    // A commodity is included in many purchase or sell invoices
    public function CommoditySellInvoices()
    {
        return $this->belongsTo(
            CommoditySellInvoice::class
        );
    }

}
