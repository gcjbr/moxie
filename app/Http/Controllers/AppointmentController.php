<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\AppointmentUpdateRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Medspa;
use App\Models\Service;
use Illuminate\Http\Request;
use function dd;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query
        $query = Appointment::query();

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by start_date if provided in the request
        if ($request->has('start_date')) {
            $query->whereDate('start_time', $request->start_date);
        }

        // Execute the query with pagination after all conditions have been set
        $appointments = $query->paginate(50);

        // Return the paginated collection of appointments
        return AppointmentResource::collection($appointments);
    }

    public function store(AppointmentRequest $request, $medspaId)
    {

        $appointment = new Appointment([
            'medspa_id' => $medspaId,
            'start_time' => $request->start_time,
        ]);


        // Attach services and calculate totals
        $services = Service::findMany($request->services);

        $appointment->total_duration = $services->sum('duration');
        $appointment->total_price = $services->sum('price');
        $appointment->save();
        $appointment->refresh();  // Refresh to fetch the default status in case it's not passed


        $appointment->services()->attach($services);


        return new AppointmentResource($appointment);
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    public function update(AppointmentUpdateRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return new AppointmentResource($appointment);
    }

}
