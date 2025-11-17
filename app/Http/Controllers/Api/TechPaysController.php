<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechPays\CreateTeachPaysRequest;
use App\Http\Requests\TechPays\UpdateTechPaysRequest;
use App\Models\TechPay;

class TechPaysController extends Controller
{
    public function index()
    {
        $techPays = TechPay::with('technicalteam')
            ->orderBy('updated_at', 'desc')
            ->get();

        $totalFinalPrice = $techPays->sum('finalprice');

        return response()->json([
            'techPays' => $techPays,
            'totalFinalPrice' => $totalFinalPrice,
        ]);
    }

    public function store(CreateTeachPaysRequest $request)
    {
        $data = $request->validated();

        $techPay  = TechPay::create($data);

        return response()->json([
            'message' => 'techPays created successfully',
            'techPay' => $techPay
        ], 201);
    }
    public function show(TechPay $techPay)
    {
        return response()->json(['techPay' => $techPay->load('technicalteam')]);
    }
    public function update(UpdateTechPaysRequest $request, TechPay $techPay)
    {
        $techPay->update($request->validated());
        return response()->json(['message' => 'techPay updated successfully', 'techPay' => $techPay]);
    }
    public function destroy(TechPay $techPay)
    {
        $techPay->delete();
        return response()->json(['message' => 'techPay deleted successfully']);
    }
}
