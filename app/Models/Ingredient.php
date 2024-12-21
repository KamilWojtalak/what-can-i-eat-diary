<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * - id
 * - created_at: timestamp
 * - updated_at: timestamp
 * - name: required string
 * - description: optional text
 * - status: string, defaults to STATUS_PENDING.
 */
class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    CONST STATUS_GOOD = 'good';
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_SUSPICIOUS = 'suspicious';
    CONST STATUS_BAD = 'bad';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Day::class);
    }
}
