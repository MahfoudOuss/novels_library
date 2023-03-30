<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show($novel,Chapter $chapter){
        
        $novel_id = $chapter->novel_id;
        $n =Novel::find($novel_id);
        $count =count($n->chapters);
        $all = $n->chapters;
       
        if ($chapter) {
            
            return view("chapter",['chapter'=>$chapter,'novel'=>$novel,'count'=>$count,'all'=>$all]);
        }
        
    } 
    
}
