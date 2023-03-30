<?php

namespace App\Http\Controllers;

use App\Jobs\Scraping;
use App\Models\Chapter;
use App\Models\Novel;
use Illuminate\Http\Request;

class NovelController extends Controller
{   public function load(){
    $started =false;
    if ($started) {
        return redirect('index');

    }
    if (!$started) {
        if(count(Novel::all()) == 0){
            $started =true;
            dispatch(new Scraping(1,2));
            sleep(6);
            return redirect('index');
        }
    }
}
    

    public function scrape(){
        if (count(Novel::all()) > 0) {
            
            return view('index',['novels'=>Novel::latest()->filter(request(['cat','search','genre','author']))->simplePaginate(10)]);
        }else {
            return view('loading');
        }

    }
    public function show(Novel $novel){
        $list =$novel->chapters();
        return view('show',[
            'novel'=>$novel,'chapters'=>$list->simplePaginate(10)]);
    }
    public function catalog(){
        $genres = Novel::pluck('genre')->toArray();
        $unique_genres =array_unique(explode('|',implode('|',$genres)));
        if (count(Novel::all()) > 0) {

            
            return view('index',['novels'=>Novel::latest()->simplePaginate(10),'genres'=>$unique_genres]);
        }else{
            return redirect('loading');
        }
        

    }
}
