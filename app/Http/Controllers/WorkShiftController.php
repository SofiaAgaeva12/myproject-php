<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpenRequest;
use App\Http\Requests\WorkShiftRequest;
use App\Http\Resources\WorkShiftResource;
use App\Models\WorkShift;
use Illuminate\Http\Request;

class WorkShiftController extends Controller
{
    public function store(WorkShiftRequest $request)
    {
        return WorkShift::create($request->all());
    }
    public function open(WorkShift $workShift, OpenRequest $openRequest)
    {
        return new WorkShiftResource($workShift->open());
    }
    public function close(WorkShift $workShift, OpenRequest $openRequest)
    {
        return new WorkShiftResource($workShift->close());
    }
}
