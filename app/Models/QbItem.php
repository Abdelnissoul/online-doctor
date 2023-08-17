<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QbItem extends Model
{
    use HasFactory;
    protected $table = "qb_items";
    protected $guarded = [];

}
