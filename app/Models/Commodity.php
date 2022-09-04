<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;

    protected $table = 'commodities';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'description', 'image_path'];

    protected $visible = ['id', 'name', 'description'];

    //protected $dateFormat = 'h:m:s';
}
