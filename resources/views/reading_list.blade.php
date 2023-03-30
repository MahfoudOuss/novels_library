<x-layout>
    @include('partials.__search')
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Reading List
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless(empty($novels)) 
                @foreach($novels as $novel)
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <a href="/novel/{{$novel->id}}">
                            <img class="hidden  mr-6 md:block" src="{{$novel->url}}" alt="" />
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="/novel/{{$novel->id}}">
                            {{$novel->title}}
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        {{$novel->status}}
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <form method="POST" action="/readinglist/delete/{{$novel->id}}">
                            @csrf 
                            @method('DELETE')
                            <button class="text-red-600">
                                <i class="fa-solid fa-trash-can"></i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 border-t py-8 border-b border-gray-300 text-lg">
                        <p class="text-center">
                            No ReadingList Found
                        </p>
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
        </x-card>
</x-layout>