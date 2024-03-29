<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * a user has many commodities
     * User: id, Commodity: user_id
     */
    public function commodities()
    {
        return $this->hasMany(Commodity::class);
    }

    /**
     * a user links commodities to many categories
     * User: id, Category: user_id
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /*
    public function soldCommodities()
    {
        return $this->hasManyThrough(Commodity::class, SoldCommodityItem::class);
    }
    */

    /**
     * a user or owner has many customers
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * a user has many supplier
     */
    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    /**
     * a user has commodity and type budgeted sales transactions
     */
    public function commodityBudgetedSales()
    {
        return $this->hasMany(CommodityBudgetedSale::class);
    }
    public function typeBudgetedSales()
    {
        return $this->hasMany(TypeBudgetedSale::class);
    }

    /**
     * a user records many sale counts from a single commodity item
     */
    public function soldCommodityItem()
    {
        return $this->hasMany(SoldCommodityItem::class);
    }
    public function soldTypeItem()
    {
        return $this->hasMany(SoldTypeItem::class);
    }

    /**
     * a user purchases commodities or types from suppliers or somewhere
     */
    public function commodityPurchases()
    {
        return $this->hasMany(CommodityPurchase::class);
    }
    public function typePurchases()
    {
        return $this->hasMany(TypePurchase::class);
    }

    /**
     * a user records sell transactions of commodities or types
     */
    public function commoditySellInvoices()
    {
        return $this->hasMany(
            CommoditySellInvoice::class,
            'user_id',
        );
    }
    public function typeSellInvoices()
    {
        return $this->hasMany(
            TypeSellInvoive::class,
            'user_id',
        );
    }

    /**
     * a user records purchase transactions of commodities or types
     */
    public function commodityPurchaseInvoices()
    {
        return $this->hasMany(CommodityPurchaseInvoice::class);
    }
    public function typePurchaseInvoices()
    {
        return $this->hasMany(TypePurchaseInvoice::class);
    }

    /**
     * a user (grocery_owner) has at least a grocery business
     */
    public function businesses()
    {
        return $this->hasOne(Business::class);
    }

}
