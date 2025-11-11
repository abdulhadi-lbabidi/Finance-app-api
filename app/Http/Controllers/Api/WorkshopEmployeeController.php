<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeWorkshop;
use App\Models\EmployeeWorksop;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workshops=Workshop::all()->load('employees');
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
            'employee_id'=>['required','integer']
            ]
        );
        $workshop = EmployeeWorkshop::create($data);

        return response()->json(['message'=>$workshop]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $allEmployees = Employee::all();
        $workshopEmployees = Workshop::find($id)->employees;
        $employeesNotInWorkshop = $allEmployees->diff($workshopEmployees);
        return response()->json(['employees'=>$employeesNotInWorkshop]);
    }
    public function showbefore(string $id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json(['employee'=>$employee]);
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
        $employee = EmployeeWorkshop::findOrFail($id);
        $employee->delete();
        return response()->json(['success'=>'message']);
    }
}
