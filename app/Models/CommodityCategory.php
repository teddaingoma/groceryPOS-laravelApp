<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityCategory extends Model
{
    use HasFactory;

    protected $table = 'commodity_categories';
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'category_id'];
    protected $visible = ['commodity_id', 'category_id'];
}
