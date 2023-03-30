@php  
$array = current($all);

@endphp

<x-layout>
    @include('partials.__search')
    <x-card class="bg-white flex flex-row justify-between">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/novels" class="inline-flex items-center text-sm font-medium text-dark-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue">
                        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="/novel/{{$chapter->novel_id}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-blue"> {{implode(' ',explode('-',$novel))}}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Chapter-{{$chapter->nbr}}</span>
                    </div>
                </li>
            </ol>
        </nav>
        

    </x-card>


    <x-card>
        @php

        $separatedcontent = explode("<br />",$chapter->content);
        $content = array_unique($separatedcontent);
        $title = array_shift($content)
        @endphp
        @if(preg_match('/Chapter|[^0-9]/',$title))
        <h1 class="text-2xl mb-3">{{$title}}</h1>
        @else 
        <p class=" mb-3 leading-relaxed text-left text-dark-500 " >{{$title}}</p>
        @endif
        <div class="flex flex-col ">
            @foreach($content as $p)
            @if(!is_numeric($p))
            <p class=" mb-3 leading-relaxed text-left text-dark-500 "> {{$p}}</p>
            @endif

            @endforeach
        </div>
    </x-card>
    <x-card>
    <div class="flex justify-center items-center">
        @php  
        $existprev =false;
        $existnext =false;
        foreach($array as $ele){
            if( $ele->id == ($chapter->id -1)){
                $existprev=true;
            }
            if( $ele->id == ($chapter->id +1)){
                $existnext=true;
            }
        }
        @endphp
        @unless($existprev == false)
            <a href="/novel/{{$novel}}/chapter/{{$chapter->id - 1}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-dark">
                Previous
            </a>
        @endunless

        @unless($existnext == false)
            <a href="/novel/{{$novel}}/chapter/{{$chapter->id + 1}}" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-dark">
                Next
            </a>
        @endunless
        </div>
    </x-card>
</x-layout>