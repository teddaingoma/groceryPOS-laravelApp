<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityCategory extends Model
{
    use HasFactory;

    protected $table = 'category_commodity';
    protected $timestamp = true;
    protected $fillable = ['commodity_id', 'category_id'];
    protected $visible = ['commodity_id', 'category_id'];
}
