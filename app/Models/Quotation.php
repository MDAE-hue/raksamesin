<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'vehicle_id',
        'quote_number',
        'unit_price',
        'shipping_cost',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'status',
        'valid_until',
        'terms',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'date',
            'unit_price' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
