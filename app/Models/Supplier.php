<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image_path',
    ];

    /**
     * The attributes that should be visible for serialization.
     *
     * @var array<int, string>
     */
    protected $visible = [
        'name',
        'email',
        'image_path',
    ];

    protected $table = 'suppliers';
    protected $primary = 'id';
    protected $timestamp = true;
}
