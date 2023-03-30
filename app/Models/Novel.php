<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{   protected $fillable =['title','tags','author','status','genre','summary','url'];
    use HasFactory;
    public function scopeFilter($query,array $filters){
        if($filters['cat'] ?? false ) {
        $query->where('genre','like', '%'.request('cat').'%');
       }
        if($filters['genre'] ?? false  ) {
         $query->where('genre','like', '%'.request('genre').'%');
        }
        if($filters['author'] ?? false  ) {
         $query->where('author','like', '%'.request('author').'%');
        }
        if($filters['search'] ?? false ) {
            $query->where('title','like', '%'.request('search').'%')
            ->orwhere('summary','like', '%'.request('search').'%')
            ->orwhere('genre','like', '%'.request('search').'%');
           }
     }
     public function users()
    {
        return $this->belongsToMany(User::class, 'reading_lists');
    }
     public function chapters()
    {
        return $this->hasMany(Chapter::class, 'novel_id');
    }
    
    
}
