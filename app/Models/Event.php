<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Event extends Model
{
    use HasFactory;
    use HasTags;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'timeline_id',
    ];

    public function timeline()
    {
        return $this->belongsTo(Timeline::class);
    }
}
