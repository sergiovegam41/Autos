<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SupportStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'support_statuses';

    protected $fillable = [

        'id',
        'name'

    ];
}
