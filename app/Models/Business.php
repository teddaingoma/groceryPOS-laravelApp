<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'businesses';

    protected $primary = 'id';

    protected $timestamp = true;

    protected $fillable = ['name', 'description', 'user_id'];

    protected $visible = ['id', 'name', 'description', 'user_id'];
}
