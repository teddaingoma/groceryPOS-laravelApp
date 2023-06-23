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
     * a user can sell a commodity many times
     */
    public function sold_commodities()
    {
        return $this->hasMany(SoldCommodityItem::class);
    }
}
