<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminType;
use Illuminate\Http\Request;

class AdminTypeController extends Controller
{
    public function index()
    {
        return response()->json(['types'=>AdminType::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:255','required'],
        ]);
        $type = AdminType::create([
            'name' => $data['name'],
        ]);

        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['type'=>AdminType::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
        ]);

        $type = AdminType::findOrFail($id);
        $type->update($data);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = AdminType::findOrFail($id);
        $type->delete();
        return response()->json(['types'=>AdminType::all()]);
    }
}
