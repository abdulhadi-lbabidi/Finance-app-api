<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogicPays\CreateLogicPaysRequest;
use App\Http\Requests\LogicPays\UpdateLogicPaysRequest;
use App\Models\LogiPay;

class LogicPaysController extends Controller
{


    public function index()
    {
        $logicPays = LogiPay::with('logisticteam')
            ->orderBy('updated_at', 'desc')
            ->get();

        $beforeDiscount = $logicPays->sum(function ($item) {
            return $item->amount * $item->price;
        });
        $afterDiscount = $logicPays->sum('finalprice');

        return response()->json([
            'logicPays' => $logicPays,
            'before_discount' => $beforeDiscount,
            'after_discount'  => $afterDiscount,

        ]);
    }
    public function store(CreateLogicPaysRequest $request)
    {
        $data = $request->validated();

        $logicPay  = LogiPay::create($data);

        return response()->json([
            'message' => 'logicPay created successfully',
            'logicPay' => $logicPay
        ], 201);
    }
    public function show(LogiPay $logicPay)
    {
        return response()->json(['logicPay' => $logicPay->load('logisticteam')]);
    }
    public function update(UpdateLogicPaysRequest $request, LogiPay $logicPay)
    {
        $logicPay->update($request->validated());
        return response()->json(['message' => 'logicPay updated successfully', 'logicPay' => $logicPay]);
    }
    public function destroy(LogiPay $logicPay)
    {
        $logicPay->delete();
        return response()->json(['message' => 'logicPay deleted successfully']);
    }
}
