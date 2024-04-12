<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireBase extends Model
{
    use HasFactory;

    protected $table = 'fire_bases';
    public $timestamps = false;
    protected $fillable = ['user_id', 'firebase'];
}
