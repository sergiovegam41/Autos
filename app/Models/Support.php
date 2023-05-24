<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "support";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Asunto',
        'Descripcion',
        'status',
        'order_id',
        'imei_id',
        'asesor_id',
        'customers_id',
        'stores_id',
    ];
}
