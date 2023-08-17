<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UCCJurisdictionMap extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'ucc_jurisdiction_map';
    protected $primaryKey = "ucc_jurisdiction_map_id";
}
