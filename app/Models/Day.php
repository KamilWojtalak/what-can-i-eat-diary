<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * - id: unsigned big integer, primary key, auto-increment.
 * - created_at: timestamp, nullable.
 * - updated_at: timestamp, nullable.
 * - date: date, required.
 * - day_of_the_week: string, required.
 * - was_not_pleasant: boolean, required, default value is false.
 * - description: text, nullable.
 */
class Day extends Model
{
    /** @use HasFactory<\Database\Factories\DayFactory> */
    use HasFactory;

    // NOTE was_not_pleasant do usuniecia
    protected $fillable = ['date', 'description', 'day_of_the_week', 'was_not_pleasant', 'status'];

    CONST STATUS_NEUTRAL = 'neutral';
    CONST STATUS_BAD = 'bad';

    protected $casts = [
        'date' => 'date',
        'was_not_pleasant' => 'boolean',
    ];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'day_ingredients');
    }

    public function isBadDay(): bool
    {
        return $this->status === self::STATUS_BAD;
    }
}
