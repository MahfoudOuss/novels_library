<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{   protected $fillable=['novel_id','nbr','content'];
    use HasFactory;
}
