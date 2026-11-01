<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    protected $guarded = ['id'];

    public const STATUSES = [
        'active'    => 'Active',
        'on_leave'  => 'On Leave',
        'resigned'  => 'Resigned',
        'dismissed' => 'Dismissed',
        'missing'   => 'Missing',
        'retired'   => 'Retired',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Teacher $teacher) {
            if (!$teacher->teacher_code) {
                do {
                    $code = 'T-' . random_int(100000, 999999);
                } while (static::where('teacher_code', $code)->exists());
    
                $teacher->teacher_code = $code;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
