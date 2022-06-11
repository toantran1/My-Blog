<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    // public $timetamps = false;

    protected $fillable= [
        'role_name','status'
    ];
    protected $primaryKey = 'user_id';
    protected $table = 'role';
}
