<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TresureFund\CreateTresureFundRequest;
use App\Http\Requests\TresureFund\UpdateTresureFundRequest;
use App\Models\InnerTransaction;
use App\Models\MoneyTranfare;
use App\Models\OuterTransaction;
use App\Models\TresureFund;

class TresureFundController extends Controller
{
  public function index()
  {
    return response()->json([
      "tresure_funds" => TresureFund::with('tresure')->get()
    ], 200);
  }
  public function store(CreateTresureFundRequest $request)
  {
    $tresureFund = TresureFund::create($request->validated());
    return response()->json([
      'message' => 'tresureFund created successfully',
      'tresureFund' => $tresureFund
    ], 201);
  }

  public function update(UpdateTresureFundRequest $request, TresureFund $tresureFund)
  {
    $tresureFund->update($request->validated());
    return response()->json([
      'message' => 'tresureFund updated successfully',
      'tresure' => $tresureFund,
    ], 200);
  }
  public function delete(TresureFund $tresureFund)
  {
    $tresureFund->delete();
    return response()->json(['message' => 'tresureFund deleted successfully']);
  }
  public function show(TresureFund $tresureFund)
  {
    // مجموع التحويلات الواردة للملحق
    $totalIncoming = MoneyTranfare::where('to_tresure_fund_id', $tresureFund->id)
      ->sum('amount');

    // مجموع التحويلات الصادرة من الملحق
    $totalOutgoing = MoneyTranfare::where('from_tresure_fund_id', $tresureFund->id)
      ->sum('amount');

    // مجموع الإيرادات (inner)
    $totalInners = InnerTransaction::where('tresure_fund_id', $tresureFund->id)
      ->sum('amount');

    // مجموع المصاريف (outer)
    $totalOuters = OuterTransaction::where('tresure_fund_id', $tresureFund->id)
      ->sum('amount');

    return response()->json([
      'tresureFund' => $tresureFund->load('tresure'),
      'stats' => [
        'total_incoming' => $totalIncoming,
        'total_outgoing' => $totalOutgoing,
        'total_transfers_sum' => $totalIncoming + $totalOutgoing,
        'total_inners' => $totalInners,
        'total_outers' => $totalOuters,
      ]
    ]);
  }



  public function getTresureFundsByTresureId(string $tresure_id)
  {
    $funds = TresureFund::where('tresure_id', $tresure_id)
      ->select('id', 'name')
      ->get();

    return response()->json([
      'funds' => $funds
    ]);
  }
}