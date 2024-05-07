<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['medspa_id', 'start_time', 'status'];


    public function medspa(): BelongsTo
    {
        return $this->belongsTo(Medspa::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'appointment_service');
    }


    public function getTotalPriceAttribute($value)
    {
        return $value / 100;  // convert to decimal for display
    }

}
