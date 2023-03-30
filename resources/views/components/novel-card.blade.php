@props(['novels'])
<x-card>
<div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{$novels->url}}" alt="" />
        <div class="flex flex-col justify-around">
            <h3 class="text-2xl">
                <a href="/novel/{{$novels->id}}">{{$novels->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">By : <a href="/?author={{$novels->author}}">{{$novels->author}}</a> </div>
            <x-novel-genre :genre="$novels->genre" />
            <div class="text-lg mt-4">
                <b>Status : </b>
                <i class="{{($novels->status == 'Completed') ? ('fa-solid fa-circle-check') : ('fa-solid fa-arrows-rotate')}}"></i> {{$novels->status}}
            </div>
        </div>
    </div>
</x-card>