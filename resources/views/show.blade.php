<x-layout>
    <x-card class="bg-white border-collapse">

        <div class="flex items-center justify-between mb-4 mx-3 text-center">
            <div>
                
                <a href="/novels" class=" text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
        @auth
        <form class="inline " method="POST" action="/novel/{{$novel->id}}/add">
            @csrf
            
            <button type="submit">
            <i class="fa-sharp fa-solid fa-plus"></i> Add to List
            </button>
            
        </form>
        
        @endauth
    </div>
</x-card>
    <div class="mx-4">

        <x-card class="p-10 bg-black ">
            <div class="flex flex-col items-center justify-center text-center ">
                <img class="w-48 mr-6 mb-6" src="{{$novel->url}}" alt="" />

                <h3 class="text-2xl mb-2">{{$novel->title}}</h3>
                <div class="text-xl font-bold mb-4"> By: <a href="/novels/?author={{$novel->author}}">{{$novel->author}}</a></div>
                <x-novel-genre :genre="$novel->genre" />
                <div class="text-lg my-4">
                    <b>Status : </b>
                    <i class="{{($novel->status == 'Completed') ? ('fa-solid fa-circle-check') : ('fa-solid fa-arrows-rotate')}}"></i> {{$novel->status}}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Summary
                    </h3>
                    <x-summary-p :sum="$novel->summary" />
                </div>
            </div>
        </x-card>
        <h4 class="flex justify-center mt-10 text-3xl font-bold"> LATEST NOVEL RELEASES :</h4>
        @php
        $name = explode(' ',$novel->title);
        $r= implode('-',$name);
        @endphp
        <x-card class="mt-10">
            <dl class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700 ">
                @foreach($chapters as $c)
                <div class="flex flex-row justify-around pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400 hover:bg-gray-100 "><a href="/novel/{{$r}}/chapter/{{$c->id}}">Chapter {{$c->nbr}}</a></dt>
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">{{$c->created_at}}</dt>
                </div>

                @endforeach
            </dl>
            
        </x-card>
        <x-card class="flex items-center justify-center bg-white">
        <div>
            {{$chapters->links()}}
        </div>
        </x-card>
    </div>
</x-layout>