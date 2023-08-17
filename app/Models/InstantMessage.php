<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstantMessage extends Model
{
    use HasFactory;
    protected $table = "instant_messages";
    protected $primaryKey = "instant_message_id";
    protected $guarded = [];
}
