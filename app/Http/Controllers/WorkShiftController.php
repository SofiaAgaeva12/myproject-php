<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\OpenRequest;
use App\Http\Requests\WorkShiftRequest;
use App\Http\Resources\WorkShiftResource;
use App\Models\ShiftWorker;
use App\Models\WorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkShiftController extends Controller
{
    public function create(WorkShiftRequest $work)
    {
        $w = WorkShift::create($work->all());

        $data = [
            "data" => [
              "id" =>  $w->id,
              "start"=> $w->start,
              "end"=> $w->end
            ]
        ];
        response()->json($data, 201);
    }
    public function open(WorkShift $work)
    {
        $w = WorkShift::where("active", 1)->first;

        if ($w) {
            throw new ApiException(403, "Forbidden. There are open shifts!");
        }
        $w = WorkShift::where("id", $work->id)->first;

        $w->active = 1;
        $w->save;
        $data = [
            "data" => [
                "id" => $w->id,
                "start" => $w->start,
                "end" => $w->end,
                "active"=> true
            ]
        ];
        response()->json($data, 200);
    }
    public function close(WorkShift $work)
    {
        $w = WorkShift::where(["id"=>$work->id, "active" => 1])->first;

        if (!$w) {
            throw new ApiException(403, "Forbidden. The shift is already closed!");
        }

        $w->active = 0;
        $w->save;
        $data = [
            "data" => [
                "id" => $w->id,
                "start" => $w->start,
                "end" => $w->end,
                "active"=> false
            ]
        ];
        response()->json($data, 200);
    }
    public function orders(WorkShift $work){
        if(Auth::user()->role->code === "waiter") {
            $s = ShiftWorker::where(['work_shift_id'=>$work->id, 'user_id' => Auth::id()])->id;
            if (!$s) {
                throw new ApiException(403, "Forbidden. You did not accept this order!");
            }
        }
    }
}
