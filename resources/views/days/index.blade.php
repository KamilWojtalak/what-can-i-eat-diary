<x-main-layout>
    Index days

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
        </thead>
        <tbody>
            @php
                $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $daysGroupedByWeek = $days->groupBy(function ($day) {
                    return \Carbon\Carbon::parse($day->date)
                        ->startOfWeek()
                        ->format('Y-m-d');
                });
            @endphp
            @foreach ($daysGroupedByWeek as $weekStart => $daysInWeek)
                @foreach ($daysOfWeek as $dayOfWeek)
                    @php
                        $day = $daysInWeek->firstWhere('day_of_the_week', $dayOfWeek);
                    @endphp
                    <td class="border px-4 py-2">
                        @if ($day)
                            <div @class(['bg-orange-200' => $day->isBadDay()])>
                                <p>
                                    <a href="{{ route('days.show', $day) }}">
                                        {{ $day->date->format('Y-m-d') }}
                                    </a>
                                </p>
                                <form action="{{ route('days.mark-as-bad-day', $day) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-orange-500">Mark as bad day</button>
                                </form>
                                <form action="{{ route('days.destroy', $day) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this day?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </div>
                        @endif
                    </td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</x-main-layout>
