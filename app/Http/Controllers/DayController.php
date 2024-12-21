<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDayRequest;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DayController extends Controller
{
    public function destroyIngredient(Day $day, $ingredientId)
    {
        $day->ingredients()->detach($ingredientId);

        return redirect()->route('days.show', $day);
    }

    public function index(): View
    {
        $days = Day::query()->orderBy('date')->get();

        return view('days.index', [
            'days' => $days,
        ]);
    }

    public function create(): View
    {
        return view('days.create');
    }

    public function store(StoreDayRequest $request)
    {
        $data = $request->validated();

        $data['day_of_the_week'] = date('l', strtotime($data['date']));

        Day::create($data);

        return redirect()->route('days.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day): View
    {
        return view('days.show', [
            'day' => $day,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Day $day)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function markAsBadDay(Request $request, Day $day)
    {
        $day->update([
            'status' => Day::STATUS_BAD,
        ]);

        return back()->with('success', 'Day marked as bad day.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day->delete();

        return redirect()->route('days.index');
    }
}
