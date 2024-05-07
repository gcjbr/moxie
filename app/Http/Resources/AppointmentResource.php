<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Appointment
 */
class AppointmentResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'start_time' => $this->start_time,
            'total_price' => $this->total_price,
            'total_duration' => $this->total_duration,
            'status' => $this->status,
            'medspa_id' => $this->medspa_id,
            'medspa' => new MedspaResource($this->whenLoaded('medspa')),
        ];
    }
}
