@props(['sum'])
<div class="text-lg space-y-6">
    @php
    $summary = explode('|',$sum)

    @endphp
    @foreach($summary as $p)
    <p>
        {{$p}}
    </p>
    @endforeach
</div>