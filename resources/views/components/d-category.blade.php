@props(['genres'])
<x-card class="bg-white">
    @if(!empty($genres))
    <div>
        <ol class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($genres as $genre)
            <x-catalog-card :cat="$genre" />
            @endforeach
        </ol>
    </div>
    @else
    <h1 class="flex items-center justify-center">
        No Novels Found
    </h1>
    @endif
</x-card>