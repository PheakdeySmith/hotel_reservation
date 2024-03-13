<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $primaryKey = 'roomtype_id';
    protected $fillable = ['roomtype_name'];
}
