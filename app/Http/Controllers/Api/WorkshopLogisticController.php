<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LogisticTeam;
use App\Models\Workshop;
use App\Models\WorkshopLogistic;
use Illuminate\Http\Request;

class WorkshopLogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops=Workshop::all()->load('logistics');
        return response()->json(['workshops'=>$workshops]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
            'workshop_id' => ['integer','required'],
            'logistic_team_id'=>['required','integer']
            ]
        );
        $workshop = WorkshopLogistic::create($data);

        return response()->json(['message'=>$workshop]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $allLogitics = LogisticTeam::all();
        $workshopLogistics = Workshop::find($id)->logistics;
        $LogisticsNotInWorkshop = $allLogitics->diff($workshopLogistics);
        return response()->json(['logistics'=>$LogisticsNotInWorkshop]);
    }
        public function showbefore(string $id)
    {
        $logistic = LogisticTeam::findOrFail($id);
        return response()->json(['logistic'=>$logistic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $logitics = WorkshopLogistic::findOrFail($id);
        $logitics->delete();
        return response()->json(['success'=>'message']);
    }
}
