<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Medspa;
use App\Models\Service;
use function dd;

class ServiceController extends Controller
{
    
    public function store(ServiceRequest $request)
    {
        $service = Service::create($request->all());

        return new ServiceResource($service);

    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return new ServiceResource($service);
    }

}
