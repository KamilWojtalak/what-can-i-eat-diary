<x-main-layout>
    Dzień: {{ $day->date->format('d.m.Y') }}

    <h2>Saved ingredients:</h2>
    <div class="border border-black my-5">
        @foreach ($day->ingredients as $ingredient)
            <div class="border border-black flex justify-between items-center">
                <p>{{ $ingredient->name }}</p>
                <form action="{{ route('days.ingredients.destroy', [$day, $ingredient]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Remove</button>
                </form>
            </div>
        @endforeach
    </div>

    <div id="vue-app">
        <day-ingredients :day-id="{{ $day->id }}" :selected="{{ json_encode($day->ingredients->pluck('id')) }}" />
    </div>
</x-main-layout>
