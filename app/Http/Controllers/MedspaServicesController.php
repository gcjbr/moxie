<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Medspa;

class MedspaServicesController extends Controller
{
    public function __invoke(Medspa $medspa)
    {
        return ServiceResource::collection($medspa->services()->paginate(50));
    }
}
