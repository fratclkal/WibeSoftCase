<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "task";
    protected $fillable = [
        'time',
        'title',
        'subject',
        'email',
        'status',
    ];

}
