<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinanceItem;
use Illuminate\Http\Request;

class FinanceItemController extends Controller
{
    public function index()
    {
        return response()->json(['items'=>FinanceItem::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['string','max:255','required'],
        ]);
        $type = FinanceItem::create($data);

        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['item'=>FinanceItem::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['string','max:100',],
        ]);

        $type = FinanceItem::findOrFail($id);
        $type->update($data);
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = FinanceItem::findOrFail($id);
        $type->delete();
        return response()->json(['items'=>FinanceItem::all()]);
    }

}
