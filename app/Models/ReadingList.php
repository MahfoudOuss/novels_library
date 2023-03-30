<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReadingList extends Model
{   protected $fillable =['user_id','novel_id',];
    use HasFactory;
    
}
