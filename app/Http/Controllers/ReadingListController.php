<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\ReadingList;
use Illuminate\Http\Request;

class ReadingListController extends Controller
{
    public function index()
    {
        return view('reading_list', ['novels' => auth()->user()->novels]);
    }
    public function store(Novel $novel)
    {   
        if (ReadingList::where('user_id', auth()->id())
        ->where('novel_id', $novel->id)
        ->first()) {
            return redirect('/novels')->with('message', 'already Added to Reading list ');
            
        }
        if(!ReadingList::where('user_id', auth()->id())
        ->where('novel_id', $novel->id)
        ->first())
   {     $user_id = auth()->id();
        $novel_id = $novel->id;
        ReadingList::create([
            'user_id' => $user_id,
            'novel_id' => $novel_id
        ]);
        return redirect('/novels/reading_list')->with('message', 'Added to Reading list succesfully');}
    }
    public function delete(Novel $novel,ReadingList $readinglist){
        $readinglist = ReadingList::where('user_id', auth()->id())
        ->where('novel_id', $novel->id)
        ->first() ;
        if($readinglist){
            $readinglist->delete();
        };
        $readinglist->delete();
            return redirect('/novels')->with('message','ReadingList deleted successfully');
        
    }
}
