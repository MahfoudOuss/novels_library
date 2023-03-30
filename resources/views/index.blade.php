<x-layout>
    @include('partials/__search')
    <div>
        @unless(empty($genres))
        <x-d-category :genres="$genres" />
        @endunless

        <x-card>
            <div>

                @foreach($novels as $novel)
                <x-novel-card :novels="$novel" />
                @endforeach
            </div>
        </x-card>
        <x-card>
            {{$novels->links()}}
        </x-card>
    </div>
</x-layout>