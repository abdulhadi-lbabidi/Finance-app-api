<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['employee'=>Employee::all()->load('user')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:100','required'],
            'phone' => ['string','max:100','required'],
            'address' => ['string','max:100','required'],
            'email' => ['email','required'],
            'password' => ['required'],
        ]);
        DB::beginTransaction();
        $employee = Employee::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
        ]);
        $employee->user()->create([
            'email' =>$data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $employee->tresure()->create([
            'name' => 'أساسي',
            'active' => true,
        ]);
        DB::commit();
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['employee'=>Employee::findOrFail($id)->load('user')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
            'phone' => ['string','max:100',],
            'address' => ['string','required'],
            'email' => ['email'],
            'password' => [],

        ]);
        DB::beginTransaction();
        $employee = Employee::findOrFail($id);
        $employee->update($data);
        $employee->user()->update([
            'email' =>$data['email'],
            'password' => $data['password']
        ]);

        DB::commit();
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        $employee = Employee::findOrFail($id);
        $employee->user()->delete();
        $employee->tresure()->delete();
        $employee->delete();
        DB::commit();
        return response()->json(['employee'=>Employee::all()->load('user')]);
    }
}
