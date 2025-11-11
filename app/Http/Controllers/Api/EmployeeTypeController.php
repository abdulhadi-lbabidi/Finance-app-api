<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployeeType;
use Illuminate\Http\Request;

class EmployeeTypeController extends Controller
{
        public function index()
    {
        return response()->json(['types'=>EmployeeType::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:255','required'],
        ]);
        $type = EmployeeType::create([
            'name' => $data['name'],
        ]);

        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['type'=>EmployeeType::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
        ]);

        $type = EmployeeType::findOrFail($id);
        $type->update($data);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = EmployeeType::findOrFail($id);
        $type->delete();
        return response()->json(['types'=>EmployeeType::all()]);
    }

}
