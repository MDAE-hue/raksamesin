<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Vehicle extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'brand',
        'model',
        'year',
        'hour_meter',
        'location',
        'price',
        'condition',
        'status',
        'is_featured',
        'is_verified',
        'images',
        'specifications',
        'description',
        'seller_id',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'specifications' => 'array',
            'is_featured' => 'boolean',
            'is_verified' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price', 'status', 'is_verified'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function imageUrl(int $index = 0): string
    {
        $image = $this->images[$index] ?? null;

        if (! $image) {
            return 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1200&q=80';
        }

        if (str_starts_with($image, 'http')) {
            return $image;
        }

        return Storage::disk('public')->url($image);
    }
}
