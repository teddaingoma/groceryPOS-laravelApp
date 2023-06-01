<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primary = 'id';
    protected $timestamp = true;
    protected $fillable = ['name', 'user_id'];
    protected $visible = ['name', 'user_id'];

    //One or more categories have or contains one or many commodities
    public function Commodities()
    {
        return $this->belongsToMany(Commodity::class);
    }

    //
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
