<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedspaRequest;
use App\Http\Resources\MedspaResource;
use App\Models\Medspa;

class MedspaController extends Controller
{
    public function index()
    {
        return MedspaResource::collection(Medspa::all());
    }

    public function store(MedspaRequest $request)
    {
        return new MedspaResource(Medspa::create($request->validated()));
    }

    public function show(Medspa $medspa)
    {
        return new MedspaResource($medspa);
    }

    public function update(MedspaRequest $request, Medspa $medspa)
    {
        $medspa->update($request->validated());

        return new MedspaResource($medspa);
    }

    public function destroy(Medspa $medspa)
    {
        $medspa->delete();

        return response()->json();
    }
}
