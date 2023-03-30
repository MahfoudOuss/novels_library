@props(['genre'])
@php
$genres =explode('|',$genre);
@endphp
<ul class="grid grid-cols-2 md:grid-cols-3 gap-4">
@foreach($genres as $g)
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="/novels/?genre={{$g}}">{{$g}}</a>
    </li>
@endforeach
</ul>