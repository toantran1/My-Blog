<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todoList extends Model
{
    use HasFactory;
    protected $fillable= [
        'task_name','status','code_task','assign'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_todoList';
}
