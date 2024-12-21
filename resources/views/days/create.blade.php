<x-main-layout>
    <form action="{{ route('days.store') }}" method="POST">
        @csrf
        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div>
            <button type="submit">Create Day</button>
        </div>
    </form>
</x-main-layout>
